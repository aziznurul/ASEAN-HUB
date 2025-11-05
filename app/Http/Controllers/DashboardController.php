<?php
namespace App\Http\Controllers;

use App\Models\Submission; // Pastikan model Submission sudah diimport
use App\Models\Vote; // Pastikan model Submission sudah diimport
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Illuminate\Support\Facades\Log;



class DashboardController extends Controller
{
    // Dashboard untuk Participant
    public function participantIndex()
    {
        // Mengambil submission yang dimiliki oleh peserta (berdasarkan user yang sedang login)
        $submission = Submission::where('user_id', Auth::id())->first();

        // Mengembalikan tampilan untuk dashboard participant, sekaligus mengirimkan data submission
        return view('dashboard.participant', compact('submission')); // Kirimkan $submission ke view
    }

    // Dashboard untuk Jury
    public function juryIndex()
    {
        // Mengambil semua submission yang ada, atau bisa difilter berdasarkan status atau kriteria lainnya
        $submissions = Submission::orderBy('created_at', 'asc')->paginate(10); // Anda bisa menambahkan filter atau sorting sesuai kebutuhan

        // Mengembalikan tampilan untuk dashboard jury, sekaligus mengirimkan data submissions
        return view('dashboard.jury', compact('submissions'));
    }

    // Menyimpan atau update submission dari participant
    public function storeOrUpdateSubmission(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'team_name' => 'required|string|max:255',
                'phone_number' => 'required|string|max:15',
                'team_members' => 'required|array|min:1',
                'team_members.*' => 'required|string|max:255',
                'pdf_file' => 'nullable|file|mimes:pdf|max:10240', // 10MB
                'video_file' => 'nullable|file|mimes:mp4,mov,avi|max:10240', // 10MB
            ]);

            // Cek apakah user sudah punya submission
            $submission = Submission::where('user_id', Auth::id())->first();

            if (!$submission) {
                $submission = new Submission();
                $submission->user_id = Auth::id();
            } else {
                if ($request->hasFile('pdf_file') && Storage::disk('public')->exists($submission->pdf_path)) {
                    Storage::disk('public')->delete($submission->pdf_path);
                }
                if ($request->hasFile('video_file') && $submission->video_path && Storage::disk('public')->exists($submission->video_path)) {
                    Storage::disk('public')->delete($submission->video_path);
                }
            }

            // Update field teks
            $submission->team_name = $request->team_name;
            $submission->phone_number = $request->phone_number;
            $submission->team_members = json_encode($request->team_members);

            // Simpan file baru jika ada
            if ($request->hasFile('pdf_file')) {
                $submission->pdf_path = $request->file('pdf_file')->store('submissions', 'public');
            }
            if ($request->hasFile('video_file')) {
                $submission->video_path = $request->file('video_file')->store('submissions', 'public');
            }

            // Simpan perubahan
            $submission->save();

            return redirect()->route('participant.dashboard')->with('success', 'Submission successfully uploaded!');
        } catch (PostTooLargeException $e) {
            // Tangani jika file terlalu besar
            Log::error('Upload gagal karena file terlalu besar: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', 'The uploaded file is too large. Please compress or reduce its size.');
        }
    }

    // Menghapus submission dari participant tetap sama
    public function destroySubmission($submissionId)
    {
        $submission = Submission::where('user_id', Auth::id())->findOrFail($submissionId);

        if (Storage::disk('public')->exists($submission->pdf_path)) {
            Storage::disk('public')->delete($submission->pdf_path);
        }
        if ($submission->video_path && Storage::disk('public')->exists($submission->video_path)) {
            Storage::disk('public')->delete($submission->video_path);
        }

        $submission->delete();

        return redirect()->route('participant.dashboard')->with('success', 'Submission successfully deleted!');
    }

    // Menampilkan detail submission peserta
    public function jurySubmissionDetail($submissionId)
    {
        // Mencari submission berdasarkan ID yang dipilih
        $submission = Submission::findOrFail($submissionId);

        // Mengembalikan tampilan detail submission
        return view('dashboard.jury-detail', compact('submission'));
    }

    public function jurySubmissionJson($submissionId)
    {
        $submission = Submission::findOrFail($submissionId);

        return response()->json([
            'id' => $submission->id,
            'team_name' => $submission->team_name,
            'phone_number' => $submission->phone_number,
            'team_members' => json_decode($submission->team_members),
            'pdf_url' => Storage::url($submission->pdf_path),
            'video_url' => $submission->video_path ? Storage::url($submission->video_path) : null,
            'score' => $submission->score,
            'feedback' => $submission->feedback,
        ]);
    }

    // Menyimpan penilaian dari juri
    public function juryEvaluateSubmission(Request $request, $submissionId)
    {
        // Validasi input penilaian
        $request->validate([
            'score' => 'required|numeric|min:0|max:100',
            'feedback' => 'nullable|string|max:500',
        ]);

        // Mencari submission berdasarkan ID yang dipilih
        $submission = Submission::findOrFail($submissionId);

        // Menyimpan penilaian dan feedback
        $submission->score = $request->score;
        $submission->feedback = $request->feedback;
        $submission->save();

        // Memberikan pesan sukses dan mengarahkan kembali ke halaman dashboard jury
        return redirect()->route('jury.dashboard')->with('success', 'Rating saved successfully!');
    }

    // Method to promote a submission to Top 10
    public function promoteToTop10($submissionId)
    {
        // Menemukan submission berdasarkan ID
        $submission = Submission::findOrFail($submissionId);

        // Pastikan submission belum menjadi finalis
        if ($submission->is_finalist) {
            return redirect()->route('jury.dashboard')->with('error', 'This submission has become a finalist');
        }

        // Menandai submission sebagai finalis (Top 10)
        $submission->is_finalist = true;
        $submission->rank = null; // Belum ada rank untuk Top 10, hanya di Top 5
        $submission->save();

        return redirect()->route('jury.top10')->with('success', 'Submission promoted to Top 10!');
    }

    // Method to promote a submission to Top 5 (from Top 10)
    public function promoteToTop5($submissionId)
    {
        // Menemukan submission berdasarkan ID
        $submission = Submission::findOrFail($submissionId);

        // Pastikan submission sudah ada di Top 10
        if (!$submission->is_finalist || $submission->rank !== null) {
            return redirect()->route('jury.top10')->with('error', 'This submission is not in the Top 10 or has been promoted to the Top 5!');
        }

        // Ambil semua submission Top 10 yang belum ada rank
        $top10 = Submission::where('is_finalist', true)->whereNull('rank')->orderByDesc('score')->get();

        // Tentukan rank berdasarkan posisi di urutan
        $rank = $top10->search(fn($item) => $item->id === $submission->id) + 1; // Dinamis, berdasarkan urutan

        // Tetapkan rank untuk submission
        $submission->rank = $rank;
        $submission->save();

        return redirect()->route('jury.top5')->with('success', 'Submission promoted to Top 5!');
    }

    // Method to display the Top 10 Finalists page
    public function top10Finalists()
    {
        // Mengambil 10 submission finalis
        $finalists = Submission::where('is_finalist', true)
                                ->whereNull('rank')  // Hanya tampilkan submission tanpa rank
                                ->orderBy('score', 'desc')  // Bisa disortir berdasarkan skor jika perlu
                                ->get();

        return view('dashboard.top10', compact('finalists'));
    }

    // Demote submission to Jury Dashboard (or Finalist/Participant)
    public function demoteFromTop10($submissionId)
    {
        $submission = Submission::findOrFail($submissionId);

        // Pastikan submission ada di Top 10
        if (!$submission->is_finalist) {
            return redirect()->route('jury.top10')->with('error', 'This submission is not in the Top 10!');
        }

        // Reset status sebagai finalis dan hapus rank
        $submission->is_finalist = false;
        $submission->rank = null; // Hilangkan rank
        $submission->save();

        return redirect()->route('jury.dashboard')->with('success', 'Submissions moved to the Judges Dashboard!');
    }

    public function demoteFromTop5ToTop10($submissionId)
    {
        $submission = Submission::findOrFail($submissionId);

        // Pastikan submission ada di Top 5
        if ($submission->rank === null) {
            return redirect()->route('jury.top5')->with('error', 'This submission is not from the Top 5!');
        }

        // Reset rank menjadi null (kembali ke Top 10)
        $submission->rank = null;
        $submission->save();

        return redirect()->route('jury.top10')->with('success', 'Submission moved back to Top 10!');
    }

    public function top5Finalists()
    {
        // Mengambil submission dengan rank yang sudah ditentukan
        $finalists = Submission::where('is_finalist', true)
                                ->whereNotNull('rank') // Hanya tampilkan submission dengan rank
                                ->orderBy('rank', 'asc') // Urutkan berdasarkan rank (rank terendah di atas)
                                ->take(5) // Ambil hanya 5 teratas
                                ->get();

        return view('dashboard.top5', compact('finalists'));
    }

    // Menampilkan daftar Top 5 Finalists untuk Voter
    public function voterIndex()
    {
        // Mengambil Top 5 submission yang sudah dipromosikan
        $submissions = Submission::where('is_finalist', true)
                                ->whereNotNull('rank')  // Hanya yang sudah memiliki rank (Top 5)
                                ->orderBy('score', 'desc') // Menyortir berdasarkan skor jika diperlukan
                                ->take(5)  // Ambil 5 submission teratas
                                ->get();

        return view('dashboard.voter', compact('submissions'));
    }

    // Menyimpan vote yang dipilih oleh voter
    public function storeVote(Request $request)
    {
        // Validasi input vote
        $request->validate([
            'submission_id' => 'required|exists:submissions,id',
        ]);

        // Cek apakah user sudah memberikan vote
        if (auth()->user()->hasVoted()) {
            return redirect()->route('voter.dashboard')->with('error', 'You have already voted!');
        }

        // Mencari submission yang dipilih
        $submission = Submission::findOrFail($request->submission_id);

        // Simpan vote
        Vote::create([
            'user_id' => auth()->id(),
            'submission_id' => $submission->id,
        ]);

        // Menambah jumlah vote pada submission
        $submission->increment('votes_count');

        return redirect()->route('voter.dashboard')->with('success', 'Vote saved successfully!');
    }

    // Membatalkan vote yang sudah dipilih oleh voter
    public function unvote(Request $request)
    {
        // Validasi input unvote
        $request->validate([
            'submission_id' => 'required|exists:submissions,id',
        ]);

        // Mencari submission yang dipilih
        $submission = Submission::findOrFail($request->submission_id);

        // Cek apakah user sudah memberikan vote
        $vote = Vote::where('user_id', auth()->id())->where('submission_id', $submission->id)->first();

        if ($vote) {
            // Hapus vote yang telah diberikan
            $vote->delete();

            // Kurangi jumlah vote pada submission
            $submission->decrement('votes_count');

            return redirect()->route('voter.dashboard')->with('success', 'Vote successfully canceled!');
        }

        return redirect()->route('voter.dashboard')->with('error', 'You havent voted for this submission yet!');
    }

    // Menampilkan dashboard admin
    public function adminIndex()
    {
        // Ambil jumlah total submission
        $totalSubmissions = Submission::count();

        // Ambil top 5 submissions berdasarkan score dan jumlah vote
        $top5Submissions = Submission::withCount('votes')
            ->orderBy('score', 'desc')
            ->orderByDesc('votes_count')
            ->limit(5)
            ->get();

        // Ambil top 10 submissions berdasarkan score
        $top10Submissions = Submission::orderBy('score', 'desc')->limit(10)->get();

        // Ambil semua users
        $users = User::orderBy('created_at', 'desc')->paginate(10);

        // Kirim data ke view
        return view('dashboard.admin', compact('totalSubmissions', 'top5Submissions', 'top10Submissions', 'users'));
    }

    // Fungsi untuk menghapus user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard.admin')->with('success', 'User successfully deleted!');
    }

    // Fungsi untuk mengubah status atau role user
    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role; // Ubah role sesuai request
        $user->save();

        return redirect()->route('dashboard.admin')->with('success', 'User role updated successfully!');
    }

}

