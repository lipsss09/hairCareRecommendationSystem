@extends('layout.admin')

@section('title', 'Manajemen Pengguna')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h1>
    <button onclick="openModal('addModal')"
        class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
        <i class="fa-solid fa-plus"></i> Tambah Pengguna
    </button>
</div>

{{-- FLASH MESSAGE --}}
@if(session('success'))
<div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-4">
    {{ session('success') }}
</div>
@endif
@if($errors->any())
<div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4">
    <ul class="list-disc pl-4 text-sm">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
</div>
@endif

{{-- TABLE --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">#</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Nama</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Username</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Email</th>
                    <th class="text-left py-3 px-4 font-semibold text-gray-600">Bergabung</th>
                    <th class="text-center py-3 px-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $i => $user)
                <tr class="border-b border-gray-100 hover:bg-pink-50/50 transition-colors">
                    <td class="py-3 px-4 text-gray-500">{{ $users->firstItem() + $i }}</td>
                    <td class="py-3 px-4 text-gray-700 font-medium">{{ $user->name }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $user->username }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $user->email }}</td>
                    <td class="py-3 px-4 text-gray-500">{{ $user->created_at->format('Y-m-d') }}</td>
                    <td class="py-3 px-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openEditUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->username) }}', '{{ addslashes($user->email) }}')"
                                class="text-blue-500 hover:text-blue-700 p-1.5 rounded-lg hover:bg-blue-50 transition">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.pengguna.destroy', $user->id) }}"
                                  onsubmit="return confirm('Hapus pengguna ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="text-red-500 hover:text-red-700 p-1.5 rounded-lg hover:bg-red-50 transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="py-8 text-center text-gray-400">Belum ada data pengguna</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="px-4 py-3 border-t border-gray-100">
        {{ $users->links() }}
    </div>
    @endif
</div>

{{-- ADD MODAL --}}
<div id="addModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white w-[450px] rounded-2xl shadow-xl p-6 relative">
        <h2 class="text-xl font-bold text-pink-500 mb-4">Tambah Pengguna</h2>
        <button onclick="closeModal('addModal')" class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-xl">&times;</button>

        <form method="POST" action="{{ route('admin.pengguna.store') }}" class="space-y-3">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition">
                Simpan Pengguna
            </button>
        </form>
    </div>
</div>

{{-- EDIT MODAL --}}
<div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50">
    <div class="bg-white w-[450px] rounded-2xl shadow-xl p-6 relative">
        <h2 class="text-xl font-bold text-pink-500 mb-4">Edit Pengguna</h2>
        <button onclick="closeModal('editModal')" class="absolute top-3 right-4 text-gray-400 hover:text-red-500 text-xl">&times;</button>

        <form id="editForm" method="POST" class="space-y-3">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" id="editName" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                <input type="text" name="username" id="editUsername" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="editEmail" required class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" class="w-full border rounded-lg px-3 py-2 text-sm">
            </div>
            <button type="submit" class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition">
                Update Pengguna
            </button>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    function openModal(id) {
        const m = document.getElementById(id);
        m.classList.remove('hidden'); m.classList.add('flex');
    }
    function closeModal(id) {
        const m = document.getElementById(id);
        m.classList.add('hidden'); m.classList.remove('flex');
    }
    function openEditUser(id, name, username, email) {
        document.getElementById('editForm').action = '/admin/pengguna/' + id;
        document.getElementById('editName').value = name;
        document.getElementById('editUsername').value = username;
        document.getElementById('editEmail').value = email;
        openModal('editModal');
    }
</script>
@endsection
