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

            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10"
                    type="password" name="password" required autocomplete="new-password" />

                <!-- Icon Mata -->
                <button type="button"
                    onclick="togglePassword('password', 'eyeOpen1', 'eyeClosed1')"
                    class="absolute inset-y-0 right-3 flex items-center text-gray-600 hover:text-gray-800">

                    <!-- Eye Open -->
                    <svg id="eyeOpen1" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.065 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- Eye Closed -->
                    <svg id="eyeClosed1" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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

            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10"
                    type="password" name="password_confirmation" required autocomplete="new-password" />

                <!-- Icon Mata -->
                <button type="button"
                    onclick="togglePassword('password_confirmation', 'eyeOpen2', 'eyeClosed2')"
                    class="absolute inset-y-0 right-3 flex items-center text-gray-600 hover:text-gray-800">

                    <!-- Eye Open -->
                    <svg id="eyeOpen2" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.065 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <!-- Eye Closed -->
                    <svg id="eyeClosed2" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
    <script>
        function togglePassword(inputId, openId, closedId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(openId);
            const eyeClosed = document.getElementById(closedId);

            if (input.type === "password") {
                input.type = "text";
                eyeOpen.classList.add("hidden");
                eyeClosed.classList.remove("hidden");
            } else {
                input.type = "password";
                eyeOpen.classList.remove("hidden");
                eyeClosed.classList.add("hidden");
            }
        }
    </script>
</x-guest-layout>
