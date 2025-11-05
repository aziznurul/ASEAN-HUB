<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,jury,participant,voter'],
        ]);

        // ✅ Tambahkan logika validasi IP di sini
        $ip = $request->ip();

        // Kalau sedang di local development, abaikan validasi IP
        if (app()->environment('local')) {
            $ip = $request->ip(); // tetap simpan tapi tidak validasi
        } else {
            // Jika bukan local, batasi 1 IP per registrasi
            $exists = \App\Models\User::where('register_ip', $ip)->exists();
            if ($exists) {
                return back()->withErrors(['ip' => 'IP address ini sudah digunakan untuk registrasi.']);
            }
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'register_ip' => $request->ip(),
        ]);

        event(new Registered($user));

        return redirect()->route('verification.notice')
                 ->with('success', 'Registrasi berhasil! Silakan cek email untuk verifikasi.');
    }

}
