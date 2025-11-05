<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Jika sudah terverifikasi sebelumnya → arahkan ke dashboard sesuai role
        if ($user->hasVerifiedEmail()) {
            return $this->redirectToRoleDashboard($user);
        }

        // Tandai email terverifikasi
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Logout setelah verifikasi dan arahkan ke login
        Auth::logout();

        return redirect()->route('login')->with('status', 'Email berhasil diverifikasi! Silakan login.');
    }

    /**
     * Redirect ke dashboard sesuai role user.
     */
    protected function redirectToRoleDashboard($user): RedirectResponse
    {
        $routeName = $user->role . '.dashboard';

        // Pastikan route tersebut ada
        if (app('router')->has($routeName)) {
            return redirect()->route($routeName)->with('verified', true);
        }

        // Jika tidak ada, fallback ke dashboard umum
        return redirect()->route('dashboard')->with('verified', true);
    }
}
