<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Top 10 Finalists') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md border border-[#2257A0] rounded-lg p-6 space-y-6">

                @if(session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',                // tipe alert: success, error, warning, info
                        title: 'Success!',             // judul alert
                        text: '{{ session('success') }}', // isi pesan dari session
                        timer: 3000,                     // alert otomatis hilang dalam 3 detik
                        timerProgressBar: true,
                        showConfirmButton: false          // tombol OK dihilangkan
                    });
                </script>
                @endif

                <h3 class="font-semibold text-lg bg-yellow-200 inline-block px-3 py-1 rounded mb-4">
                    Top 10 Finalists
                </h3>
                <hr class="mb-2 border-[#2257A0]">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="py-2 text-left">Team Name</th>
                            <th class="py-2 text-left">Score</th>
                            <th class="py-2 text-left">Feedback</th>
                            <th class="py-2 text-left">Promote / Demote</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($finalists as $submission)
                        <tr>
                            <td>{{ $submission->team_name }}</td>
                            <td>{{ $submission->score }}</td>
                            <td>{{ $submission->feedback ?? 'No feedback' }}</td>
                            <td>
                                <div class="flex flex-col sm:flex-row gap-2">
                                    <!-- Promote to Top 5 -->
                                    <form action="{{ route('jury.promoteToTop5', $submission->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-yellow-500 text-white py-1 px-3 rounded hover:bg-yellow-600">
                                            Promote to Top 5
                                        </button>
                                    </form>

                                    <!-- Demote to Jury Dashboard -->
                                    <form action="{{ route('jury.demoteFromTop10', $submission->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">
                                            Demote to Jury Dashboard
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
