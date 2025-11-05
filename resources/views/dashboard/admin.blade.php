<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',                  // tipe alert
            title: 'Success!',               // judul alert
            text: '{{ session('success') }}', // isi pesan
            timer: 3000,                       // alert otomatis hilang setelah 3 detik
            timerProgressBar: true,
            showConfirmButton: false
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
            showConfirmButton: false
        });
    </script>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border border-[#2257A0] rounded-lg p-6 space-y-6">

                <!-- Agregat Jumlah Submission -->
                <div class="mb-6">
                    <h3 class="font-semibold text-lg bg-yellow-200 inline-block px-3 py-1 rounded mb-4">
                        Total Submissions
                    </h3>
                </div>
                <div class="shadow-md border border-[#2257A0] rounded-lg p-4 w-full sm:max-w-xs">
                    <p class="text-gray-800 font-semibold">
                        {{ $totalSubmissions }} submissions
                    </p>
                </div>

                <!-- Top 5 Submissions -->
                <h3 class="font-semibold text-lg bg-yellow-200 inline-block px-3 py-1 rounded mb-4">
                    Top 5 Submissions
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($top5Submissions as $submission)
                        <div class="bg-white shadow-md border border-[#2257A0]  rounded-lg p-4">
                            <h4 class="font-semibold text-lg">{{ $submission->team_name }}</h4>
                            <p><strong>Score:</strong> {{ $submission->score }}</p>
                            <p><strong>Votes:</strong> {{ $submission->votes_count }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Top 10 Submissions -->
                <h3 class="font-semibold text-lg bg-yellow-200 inline-block px-3 py-1 rounded mb-4">
                    Top 10 Submissions
                </h3>
                <div class="space-y-4">
                    @foreach($top10Submissions as $submission)
                        <div class="bg-white shadow-md border border-[#2257A0] rounded-lg p-4">
                            <h4 class="font-semibold text-lg">{{ $submission->team_name }}</h4>
                            <p><strong>Score:</strong> {{ $submission->score }}</p>
                        </div>
                    @endforeach
                </div>

                <!-- Daftar User -->
                <h3 class="font-semibold text-lg bg-yellow-200 inline-block px-3 py-1 rounded mb-4">
                    User Management
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full table-auto bg-white shadow-md rounded-lg border-separate border-spacing-0">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-left">Name</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Role</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b">
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">{{ $user->role }}</td>
                                    <td class="px-4 py-2">
                                        <div class="space-y-2">
                                            <!-- Update Role -->
                                            <form action="{{ route('admin.updateUserRole', $user->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                <select name="role" class="border px-2 py-1 rounded-md text-sm w-40">
                                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="voter" {{ $user->role == 'voter' ? 'selected' : '' }}>Voter</option>
                                                    <option value="participant" {{ $user->role == 'participant' ? 'selected' : '' }}>Participant</option>
                                                    <option value="jury" {{ $user->role == 'jury' ? 'selected' : '' }}>Jury</option>
                                                </select>
                                                <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded hover:bg-blue-600 text-sm ml-2">Update</button>
                                            </form>
                                            
                                            <!-- Delete User -->
                                            <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600 text-sm">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-6 flex justify-end">
                    {{ $users -> links ('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
