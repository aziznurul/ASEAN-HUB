<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jury Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ openModal: false, submission: null, loading: false }">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-lg p-6 space-y-6">

                @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',           // tipe alert: success, error, warning, info
                        title: 'Success!',        // judul alert
                        text: '{{ session('success') }}', // isi dari session
                        timer: 3000,               // alert otomatis hilang dalam 3 detik
                        timerProgressBar: true,
                        showConfirmButton: false   // hilangkan tombol OK
                    });
                </script>
                @endif

                <!-- Submission List -->
                <h3 class="font-semibold text-lg bg-yellow-200 inline-block px-3 py-1 rounded mb-4">
                    Submission List
                </h3>
                <hr class="mb-2 border-[#2257A0]">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left">Team Name</th>
                            <th class="px-4 py-2 text-left">Phone Number</th>
                            <th class="px-4 py-2 text-left">View Submission</th>
                            <th class="px-4 py-2 text-left">Action</th>
                            <th class="px-4 py-2 text-left">Score</th>
                            <th class="px-4 py-2 text-left">Feedback</th>
                            <th class="px-4 py-2 text-left">Promote / Demote</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                            <tr>
                                <td class="px-4 py-2">{{ $submission->team_name }}</td>
                                <td class="px-4 py-2">{{ $submission->phone_number }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ Storage::url($submission->pdf_path) }}" target="_blank" class="text-blue-600 underline">View PDF</a>
                                </td>
                                <td class="px-4 py-2">
                                    <button
                                        @click="
                                            loading = true;
                                            fetch('{{ route('jury.submission.json', $submission->id) }}')
                                                .then(res => res.json())
                                                .then(data => { submission = data; openModal = true })
                                                .finally(() => loading = false)
                                        "
                                        class="text-yellow-500 hover:text-yellow-600"
                                    >
                                        View Details
                                    </button>
                                </td>
                                <td class="px-4 py-2">{{ $submission->score }}</td>
                                <td class="px-4 py-2">{{ $submission->feedback }}</td>
                                <td>
                                    <!-- Tombol Promote -->
                                    @if(!$submission->is_finalist)
                                        <!-- Promote to Top 10 button -->
                                        <form action="{{ route('jury.promoteToTop10', $submission->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600">
                                                Promote to Top 10
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div class="mt-6 flex justify-end">
                    {{ $submissions -> links ('pagination::tailwind') }}
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div
            x-show="openModal"
            x-cloak
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
        >
            <div class="bg-white rounded-lg shadow-lg w-11/12 max-w-3xl p-6 overflow-y-auto max-h-[90vh]">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">Submission Detail</h2>
                    <button @click="openModal = false" class="text-gray-600 hover:text-gray-800">&times;</button>
                </div>

                <!-- Loading Spinner -->
                <div x-show="loading" class="text-center py-10">
                    <div class="animate-spin rounded-full h-8 w-8 border-t-2 border-b-2 border-yellow-400 mx-auto"></div>
                    <p class="mt-2 text-gray-500 text-sm">Loading...</p>
                </div>

                <!-- Detail Content -->
                <template x-if="submission && !loading">
                    <div class="space-y-6">

                        <!-- Team Info -->
                        <div>
                            <h3 class="font-semibold text-lg mb-2">Team Information</h3>
                            <p><strong>Team Name:</strong> <span x-text="submission.team_name"></span></p>
                            <p><strong>Phone Number:</strong> <span x-text="submission.phone_number"></span></p>
                            <p><strong>Team Members:</strong> <span x-text="submission.team_members?.join(', ')"></span></p>
                        </div>

                        <!-- PDF -->
                        <div>
                            <p><strong>PDF:</strong>
                                <a :href="submission.pdf_url" target="_blank" class="text-blue-600 underline">View PDF</a>
                            </p>
                        </div>

                        <!-- Video -->
                        <template x-if="submission.video_url">
                            <div>
                                <p><strong>Video:</strong></p>
                                <video class="w-full max-w-md mt-1 rounded-md border" controls>
                                    <source :src="submission.video_url" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </template>
                        <!-- Evaluation Form -->
                        <form :action="'/jury/submission/' + submission.id + '/evaluate'" method="POST" class="space-y-4 mt-6">
                            @csrf

                            <div>
                                <label for="score" class="block text-sm font-medium text-gray-700">Score (0-100)</label>
                                <input type="number" id="score" name="score" min="0" max="100"
                                       :value="submission.score"
                                       class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                            </div>

                            <div>
                                <label for="feedback" class="block text-sm font-medium text-gray-700">Feedback</label>
                                <textarea id="feedback" name="feedback" rows="4"
                                          class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-yellow-400 focus:outline-none"
                                          x-text="submission.feedback ?? ''"></textarea>
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                        class="bg-yellow-400 hover:bg-yellow-500 text-gray-800 font-semibold px-6 py-2 rounded-lg shadow-md transition">
                                    Submit Evaluation
                                </button>
                            </div>
                        </form>
                    </div>
                </template>
            </div>
        </div>
    </div>
</x-app-layout>
