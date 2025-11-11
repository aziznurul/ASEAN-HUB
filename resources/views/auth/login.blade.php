<x-guest-layout>
    <!-- Page Title -->
    <h1 class="text-2xl font-semibold text-center mb-6 text-gray-800">
        ASEAN Hub International Design Competition 2026
    </h1>

    <!-- Logo -->
    <div class="flex justify-center mb-6">
        <img src="{{ asset('asset/images/logo.png') }}" alt="Custom Logo" class="w-3/4 md:w-1/2">
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session("status") }}',
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />

            @error('email')
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ $message }}',
                        confirmButtonColor: '#d33',
                    });
                </script>
            @enderror
        </div>

        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="flex items-center mt-1">
                <x-text-input id="password" class="w-full"
                    type="password" name="password" required autocomplete="current-password" />

                <!-- Icon di pinggir -->
                <button type="button" id="togglePassword"
                    class="ml-3 text-gray-600 hover:text-gray-800 flex items-center">

                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.065 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 hidden"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7
                            a10.05 10.05 0 012.03-3.362m3.408-2.241
                            A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7
                            a9.96 9.96 0 01-4.132 5.314" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3l18 18" />
                    </svg>

                </button>
            </div>
        </div>


        <!-- Remember Me -->
        <div class="flex items-center mb-4">
            <input id="remember_me" type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
        </div>

        <!-- Login Button + Forgot Password -->
        <div class="flex items-center justify-between">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ml-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Register Link -->
        @if (Route::has('register'))
            <p class="text-center text-sm text-gray-600 mt-6">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-800 font-medium">
                    {{ __('Register here') }}
                </a>
            </p>
        @endif
    </form>
    <script>
        const passwordInput = document.getElementById("password");
        const togglePassword = document.getElementById("togglePassword");
        const eyeOpen = document.getElementById("eyeOpen");
        const eyeClosed = document.getElementById("eyeClosed");

        togglePassword.addEventListener("click", () => {
            const isHidden = passwordInput.type === "password";
            passwordInput.type = isHidden ? "text" : "password";

            eyeOpen.classList.toggle("hidden");
            eyeClosed.classList.toggle("hidden");
        });
    </script>

    <!-- Back to Home Link --> 
    <div class="text-center mt-6"> <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-900 font-medium"> &larr; Back to Home </a> </div>
</x-guest-layout>
