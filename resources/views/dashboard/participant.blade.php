<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Participant Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg p-6 space-y-6">

                @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                </script>
                @endif

                @if(session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: '{{ session('error') }}',
                        timer: 3000,
                        timerProgressBar: true,
                        showConfirmButton: false,
                    });
                </script>
                @endif

                <!-- Current Submission -->
                @if($submission)
                    <div class="p-4 border border-[#2257A0] rounded-md">
                        <h3 class="font-semibold text-lg bg-yellow-200 inline-block px-3 py-1 rounded mb-4">
                            Your Current Submission
                        </h3>
                        <hr class="mb-2 border-[#2257A0]">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Left Column -->
                            <div class="space-y-2">
                                <p><strong>Team Name:</strong> {{ $submission->team_name }}</p>
                                <p><strong>Phone Number:</strong> {{ $submission->phone_number }}</p>
                                @php
                                    $teamMembers = json_decode($submission->team_members, true);
                                @endphp
                                <p><strong>Team Members:</strong> {{ implode(', ', $teamMembers) }}</p>
                            </div>

                            <!-- Right Column -->
                            <div class="space-y-3">
                                <div>
                                    <p><strong>Video:</strong></p>
                                    <video class="w-full max-w-md mt-1 rounded-md border" controls>
                                        <source src="{{ Storage::url($submission->video_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-900 mb-3">
                                        File PDF:
                                        <a href="{{ Storage::url($submission->pdf_path) }}" 
                                        target="_blank"
                                        class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                            <svg xmlns="http://www.w3.org/2000/svg" 
                                                class="w-5 h-5 mr-1 text-red-500" 
                                                fill="currentColor" 
                                                viewBox="0 0 24 24">
                                                <path d="M6 2a2 2 0 00-2 2v16c0 1.103.897 2 2 2h12a2 2 0 002-2V8l-6-6H6zm7 7V3.5L18.5 9H13zM8 13h1.5c.827 0 1.5.673 1.5 1.5S10.327 16 9.5 16H8v-3zm0 4h1.5c1.381 0 2.5-1.119 2.5-2.5S10.881 12 9.5 12H8v5zM13 12h1v4h-1v-4zm3 0h1v4h-1v-4z"/>
                                            </svg>
                                            <span>View PDF</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Delete Submission -->
                        <form id="delete-submission-form" action="{{ route('participant.submission.destroy', $submission->id) }}" method="POST" class="mt-4 text-center md:text-right">
                            @csrf
                            @method('DELETE')
                            <button type="button" id="delete-button" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md font-semibold transition">
                                Delete Submission
                            </button>
                        </form>
                    </div>
                @endif


                <!-- Upload Submission Form -->
                <form action="{{ route('participant.submission.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Left: Team Info -->
                        <div class="space-y-4">
                            <div>
                                <label for="team_name" class="block text-sm font-medium text-gray-700 mb-1">Team Name</label>
                                <input type="text" name="team_name" id="team_name"
                                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                                    value="{{ old('team_name', $submission->team_name ?? '') }}" placeholder="Team Name" required>
                                @error('team_name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number"
                                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                                    value="{{ old('phone_number', $submission->phone_number ?? '') }}" placeholder="08xxxxxxxxxx" required>
                                @error('phone_number')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Team Members</label>
                                <div id="team-members-container" class="space-y-2">
                                @php
                                    $members = $submission ? json_decode($submission->team_members, true) : []; 
                                @endphp

                                <div>
                                    <div id="team-members-container" class="space-y-2">
                                        @if (count($members) > 0)
                                            @foreach($members as $index => $member)
                                                <div class="flex space-x-2">
                                                    <input type="text" name="team_members[]" value="{{ $member }}" 
                                                        class="flex-1 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                                                        placeholder="Member Name" required>
                                                    @if($index == 0)
                                                        <button type="button" id="add-member"
                                                            class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-semibold transition">+</button>
                                                    @else
                                                        <button type="button" class="remove-member px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md font-semibold transition">-</button>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <!-- Form kosong jika tidak ada team members -->
                                            <div class="flex space-x-2">
                                                <input type="text" name="team_members[]" value="" 
                                                    class="flex-1 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                                                    placeholder="Member Name" required>
                                                <button type="button" id="add-member"
                                                    class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-semibold transition">+</button>
                                            </div>
                                        @endif
                                    </div>
                                    @error('team_members.*')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                                </div>
                                </div>
                                @error('team_members.*')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <!-- Right: File Uploads -->
                        <div class="space-y-4">
                            <div>
                                <label for="video_file" class="block text-sm font-medium text-gray-700 mb-1">Upload Video</label>
                                <input type="file" name="video_file" id="video_file"
                                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                                <p class="text-gray-500 text-xs mt-1">Accepted formats: MP4, MOV, AVI. Max 10MB</p>
                                @error('video_file')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="pdf_file" class="block text-sm font-medium text-gray-700 mb-1">Upload PDF</label>
                                <input type="file" name="pdf_file" id="pdf_file"
                                    class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none" required>
                                <p class="text-gray-500 text-xs mt-1">Accepted format: PDF, max 10MB</p>
                                @error('pdf_file')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-semibold px-6 py-2 rounded-lg shadow-md transition">
                            Upload Submission
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.0/dist/sweetalert2.all.min.js"></script>
    <script>
        // Add/remove team members
        document.getElementById('add-member')?.addEventListener('click', function() {
            let container = document.getElementById('team-members-container');
            let div = document.createElement('div');
            div.classList.add('flex', 'space-x-2');
            div.innerHTML = '<input type="text" name="team_members[]" class="flex-1 border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none" placeholder="Member Name" required>' +
                            '<button type="button" class="remove-member px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded-md font-semibold transition">-</button>';
            container.appendChild(div);
        });

        document.addEventListener('click', function(e) {
            if(e.target && e.target.classList.contains('remove-member')) {
                e.target.parentNode.remove();
            }
        });

        // SweetAlert Delete
        document.getElementById('delete-button')?.addEventListener('click', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "Your submission will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-submission-form').submit();
                }
            });
        });
    </script>
</x-app-layout>
