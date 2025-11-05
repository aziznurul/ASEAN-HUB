<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ResourcesController;
use App\Http\Controllers\GuidelineController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ExhibitionController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 🔹 Halaman utama (public)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/resources', [ResourcesController::class, 'index'])->name('resources');
Route::get('/guideline', [GuidelineController::class, 'index'])->name('guideline');
Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
Route::get('/finalists', [AnnouncementController::class, 'showFinalists'])->name('finalists');
Route::get('/exhibition', [ExhibitionController::class, 'index'])->name('exhibition');

// ======================================================
// 🔹 Redirect otomatis setelah login berdasarkan role
// ======================================================
Route::middleware(['auth', 'verified'])->get('/redirect', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    // Redirect berdasarkan role
    switch ($user->role) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'jury':
            return redirect()->route('jury.dashboard');
        case 'participant':
            return redirect()->route('participant.dashboard');
        case 'voter':
            return redirect()->route('voter.dashboard');
        default:
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'role' => 'Role tidak dikenali.'
            ]);
    }
})->name('redirect');

// ======================================================
// 🔹 DASHBOARD PER ROLE
// ======================================================

// Group route for dashboards based on roles
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Participant Dashboard
    Route::get('/participant/dashboard', [DashboardController::class, 'participantIndex'])
        ->name('participant.dashboard');

    // Ubah POST route agar memanggil storeOrUpdateSubmission
    Route::post('/participant/submission', [DashboardController::class, 'storeOrUpdateSubmission'])
        ->name('participant.submission.store');

    Route::delete('/participant/submission/{submission}', [DashboardController::class, 'destroySubmission'])
        ->name('participant.submission.destroy');

    // Jury Dashboard
    Route::get('/jury/dashboard', [DashboardController::class, 'juryIndex'])->name('jury.dashboard');

    // Submission Detail & Evaluation
    Route::get('/jury/submission/{submissionId}/detail', [DashboardController::class, 'jurySubmissionDetail'])->name('jury.submission.detail');
    Route::post('/jury/submission/{submissionId}/evaluate', [DashboardController::class, 'juryEvaluateSubmission'])->name('jury.submission.evaluate');
    Route::get('/jury/submission/{submissionId}/json', [DashboardController::class, 'jurySubmissionJson'])->name('jury.submission.json');

    // Promote / Demote
    Route::post('/jury/submission/{submissionId}/promote', [DashboardController::class, 'promoteToTop10'])->name('jury.promoteToTop10');
    Route::post('/jury/submission/{submissionId}/promote-top5', [DashboardController::class, 'promoteToTop5'])->name('jury.promoteToTop5');
    Route::post('/jury/demote/{submissionId}', [DashboardController::class, 'demoteFromTop10'])->name('jury.demoteFromTop10');
    Route::post('/jury/demote-top5/{submissionId}', [DashboardController::class, 'demoteFromTop5ToTop10'])->name('jury.demoteFromTop5');

    // Finalists Display
    Route::get('/jury/top10', [DashboardController::class, 'top10Finalists'])->name('jury.top10');
    Route::get('/jury/top5', [DashboardController::class, 'top5Finalists'])->name('jury.top5');



    // Voter Dashboard
    Route::get('/voter/dashboard', [DashboardController::class, 'voterIndex'])->name('voter.dashboard');
    Route::post('/voter/vote', [DashboardController::class, 'storeVote'])->name('voter.vote');
    // routes/web.php
    Route::post('/voter/vote', [DashboardController::class, 'storeVote'])->name('voter.vote');
    Route::post('/voter/unvote', [DashboardController::class, 'unvote'])->name('voter.unvote');


    // Admin dashboard
    Route::get('/admin/dashboard', [DashboardController::class, 'adminIndex'])->name('admin.dashboard');
    
    Route::post('/admin/update-role/{id}', [DashboardController::class, 'updateUserRole'])->name('admin.updateUserRole');

    Route::delete('/admin/delete-user/{id}', [DashboardController::class, 'deleteUser'])->name('admin.deleteUser');

});

// ======================================================
// 🔹 Profile
// ======================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
