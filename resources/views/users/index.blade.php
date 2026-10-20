@extends('layouts.app')

@section('title', 'Manajemen Staf & Petugas')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4" data-guide="users-header">
        <div>
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-bold text-gray-900">Manajemen Staf & Petugas</h2>
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700 border border-indigo-200">Khusus Administrator</span>
            </div>
            <p class="text-gray-600 mt-1">Kelola akun pengguna yang berhak mengakses sistem perpustakaan</p>
        </div>

        <button type="button" onclick="document.getElementById('addStaffModal').classList.remove('hidden')" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors whitespace-nowrap cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Tambah Akun Staf Baru
        </button>
    </div>

    <!-- Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4" data-guide="users-stats">
        <div class="p-4 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Staf</p>
                <p class="text-2xl font-extrabold text-gray-900 mt-1">{{ $totalStaff }}</p>
            </div>
            <span class="p-2.5 rounded-xl bg-gray-100 text-gray-600">👥</span>
        </div>

        <div class="p-4 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-indigo-600 uppercase tracking-wider">Administrator</p>
                <p class="text-2xl font-extrabold text-indigo-900 mt-1">{{ $adminCount }}</p>
            </div>
            <span class="p-2.5 rounded-xl bg-indigo-50 text-indigo-600">🛡️</span>
        </div>

        <div class="p-4 rounded-xl bg-white border border-gray-200 shadow-xs flex items-center justify-between">
            <div>
                <p class="text-xs font-semibold text-emerald-600 uppercase tracking-wider">Petugas Sirkulasi</p>
                <p class="text-2xl font-extrabold text-emerald-900 mt-1">{{ $petugasCount }}</p>
            </div>
            <span class="p-2.5 rounded-xl bg-emerald-50 text-emerald-600">💼</span>
        </div>
    </div>

    <!-- Role Explanation Banner -->
    <div class="p-4 rounded-xl bg-gradient-to-r from-indigo-50 via-sky-50 to-emerald-50 border border-indigo-100/80 text-xs text-gray-700" data-guide="users-roles">
        <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-1.5 text-sm">
            <span>ℹ️</span> Panduan Hak Akses Sistem
        </h3>
        <div class="grid sm:grid-cols-2 gap-3 text-xs">
            <div class="p-2.5 bg-white/80 rounded-lg border border-indigo-100">
                <span class="font-bold text-indigo-700 block mb-0.5">🛡️ Administrator:</span>
                <p class="text-gray-600">Akses mutlak. Mampu mengelola buku (tambah, edit, hapus), memanajemen data anggota, melihat analitik denda, dan membuat akun staf baru.</p>
            </div>
            <div class="p-2.5 bg-white/80 rounded-lg border border-emerald-100">
                <span class="font-bold text-emerald-700 block mb-0.5">💼 Petugas Sirkulasi:</span>
                <p class="text-gray-600">Fokus operasional front-desk. Melayani transaksi peminjaman baru, penerimaan pengembalian buku, denda, dan cek ketersediaan stok buku di katalog.</p>
            </div>
        </div>
    </div>

    <!-- Staff Table -->
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-xs" data-guide="users-table">
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <h3 class="font-bold text-gray-900 text-base">Daftar Akun Staf Perpustakaan</h3>
            <form method="GET" class="flex items-center gap-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama atau email..."
                    class="px-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
                <select name="role" onchange="this.form.submit()" class="px-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                    <option value="">Semua Peran</option>
                    <option value="Admin" {{ request('role') === 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Petugas" {{ request('role') === 'Petugas' ? 'selected' : '' }}>Petugas</option>
                </select>
                @if(request()->hasAny(['search', 'role']))
                <a href="{{ route('users.index') }}" class="text-xs text-gray-500 hover:text-gray-800">Reset</a>
                @endif
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left" role="table">
                <thead class="bg-gray-50/75 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5">Nama & Profil</th>
                        <th class="px-6 py-3.5">Email Akun</th>
                        <th class="px-6 py-3.5">Peran (Role)</th>
                        <th class="px-6 py-3.5">Terdaftar Pada</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @foreach ($users as $user)
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-6 py-3.5">
                            <div class="flex items-center gap-3">
                                @if($user->isAdmin())
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-indigo-700 to-purple-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                @else
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                @endif
                                <div>
                                    <div class="font-bold text-gray-900 flex items-center gap-1.5">
                                        <span>{{ $user->name }}</span>
                                        @if(auth()->id() === $user->id)
                                            <span class="text-[10px] font-semibold bg-gray-100 text-gray-600 px-1.5 py-0.2 rounded">Anda</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-3.5 text-xs font-mono text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-3.5">
                            @if($user->isAdmin())
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-indigo-50 text-indigo-700 border border-indigo-200">
                                <span>🛡️</span> Administrator
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span>💼</span> Petugas Sirkulasi
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-3.5 text-xs text-gray-500">{{ $user->created_at?->translatedFormat('d M Y') ?? '-' }}</td>
                        <td class="px-6 py-3.5 text-right">
                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun staf {{ $user->name }}?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 text-xs font-semibold text-rose-600 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
                                    Hapus
                                </button>
                            </form>
                            @else
                            <span class="text-xs text-gray-400 italic">Akun aktif</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>
</div>

<!-- Modal Tambah Staf Baru -->
<div id="addStaffModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/50 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-xl relative animate-fade-in border border-gray-100">
        <div class="flex items-center justify-between pb-3 border-b border-gray-100 mb-4">
            <h3 class="text-lg font-bold text-gray-900">Tambah Akun Staf Baru</h3>
            <button type="button" onclick="document.getElementById('addStaffModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600 text-xl font-bold">&times;</button>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    required
                    placeholder="Nama staf perpustakaan"
                    class="w-full px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Alamat Email <span class="text-rose-500">*</span>
                </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                    placeholder="email@perpustakaan.test"
                    class="w-full px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label for="role" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Peran / Hak Akses <span class="text-rose-500">*</span>
                </label>
                <select name="role" id="role" required class="w-full px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                    <option value="Petugas">Petugas Sirkulasi (Pelayanan Pinjam & Kembali)</option>
                    <option value="Admin">Administrator (Hak Akses Penuh)</option>
                </select>
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1">
                    Kata Sandi Awal <span class="text-rose-500">*</span>
                </label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    minlength="6"
                    placeholder="Minimal 6 karakter"
                    class="w-full px-3.5 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div class="flex items-center justify-end gap-2 pt-4 border-t border-gray-100">
                <button type="button" onclick="document.getElementById('addStaffModal').classList.add('hidden')" class="px-4 py-2 border border-gray-300 rounded-lg text-xs font-semibold text-gray-700 hover:bg-gray-50">
                    Batal
                </button>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg shadow-sm">
                    Simpan Akun
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

