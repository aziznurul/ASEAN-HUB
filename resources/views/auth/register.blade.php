<x-guest-layout>
    <!-- Page Title -->
    <h1 class="text-xl font-semibold text-center mb-6 text-gray-800">
        ASEAN Hub International Design Competition 2026
    </h1>

    <!-- Logo -->
    <div class="flex justify-center mb-4">
        <img src="{{ asset('asset/images/logo.png') }}" alt="Custom Logo" class="w-3/4 md:w-1/2">
    </div>

    <!-- Include SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Form Register -->
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            @error('name')
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ $message }}',
                        confirmButtonColor: '#d33'
                    });
                </script>
            @enderror
        </div>

        <!-- Role -->
        <div class="mb-4">
            <x-input-label for="role" :value="__('Select Role')" />
            <select id="role" name="role" class="block mt-1 w-full rounded-md border-gray-300" required>
                <option value="">-- Select Role --</option>
                <option value="participant">Participant</option>
                <option value="voter">Voter</option>
                <option value="jury">Jury</option>
                <option value="admin">Admin</option>
            </select>
            @error('role')
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ $message }}',
                        confirmButtonColor: '#d33'
                    });
                </script>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            @error('email')
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ $message }}',
                        confirmButtonColor: '#d33'
                    });
                </script>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ $message }}',
                        confirmButtonColor: '#d33'
                    });
                </script>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '{{ $message }}',
                        confirmButtonColor: '#d33'
                    });
                </script>
            @enderror
        </div>

        <!-- Register Button + Login Link -->
        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
