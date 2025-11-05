<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Voter Dashboard') }}
        </h2>
    </x-slot>
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg p-6 space-y-6">
                <h3 class="font-semibold text-lg bg-yellow-200 inline-block px-3 py-1 rounded">
                    Choose the Best Submission from the Top 5
                </h3>

                <!-- Grid untuk menampilkan submission -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($submissions as $submission)
                        <div class="bg-white border border-[#2257A0] rounded-lg p-4">
                            {{-- <h4 class="font-semibold text-lg">{{ $submission->team_name }}</h4>
                            <p><strong>Team Members:</strong> {{ implode(', ', json_decode($submission->team_members)) }}</p>
                            <p><strong>Score:</strong> {{ $submission->score ?? 'Not yet scored' }}</p>
                            <p><strong>Feedback:</strong> {{ $submission->feedback ?? 'No feedback yet' }}</p>  --}}
                            <video class="rounded shadow-sm w-full h-40 object-cover mb-4" controls>
                                <source src="{{ Storage::url($submission->video_path) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                            </video>
                            <!-- Menampilkan link PDF -->
                            @if($submission->pdf_path)
                                <p><strong>PDF File:</strong> <a href="{{ Storage::url($submission->pdf_path) }}" target="_blank" class="text-blue-500">View PDF</a></p>
                            @endif
                            <p class="text-lg">{{ $submission->team_name }}</p>

                            <!-- Menampilkan link Video -->
                            {{-- @if($submission->video_path)
                                <p><strong>Video File:</strong> <a href="{{ Storage::url($submission->video_path) }}" target="_blank" class="text-blue-500">Watch Video</a></p>
                            @endif  --}}

                            <!-- Tombol untuk memberikan vote atau unvote -->
                            @if(auth()->user()->hasVotedFor($submission))
                                <!-- Tombol Unvote jika user sudah memberi vote -->
                                <form action="{{ route('voter.unvote') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                                    <button type="submit" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600">
                                        Unvote
                                    </button>
                                </form>
                            @else
                                <!-- Tombol Vote jika user belum memberi vote -->
                                <div class="flex justify-center mt-4">
                                <form action="{{ route('voter.vote') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="submission_id" value="{{ $submission->id }}">
                                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                                        Vote
                                    </button>
                                </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <!-- Pastikan untuk memuat SweetAlert2 script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</x-app-layout>
