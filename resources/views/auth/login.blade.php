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

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />

            @error('password')
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
    <!-- Back to Home Link --> 
    <div class="text-center mt-6"> <a href="{{ url('/') }}" class="text-gray-600 hover:text-gray-900 font-medium"> &larr; Back to Home </a> </div>
</x-guest-layout>
