@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4" data-guide="members-header">
        <div>
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-bold text-gray-900">Data Anggota</h2>
                @if(auth()->user()->isAdmin())
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700 border border-indigo-200">Mode Admin</span>
                @else
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">Mode Petugas</span>
                @endif
            </div>
            <p class="text-gray-600 mt-1">Kelola dan verifikasi keanggotaan perpustakaan</p>
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden sm:flex items-center gap-2 text-sm text-gray-600">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                    Total: {{ $totalMembers }}
                </span>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary-100 text-primary-800">
                    Aktif: {{ $activeMembers }}
                </span>
            </div>

            @if(auth()->user()->isAdmin())
            <a href="{{ route('members.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                Tambah Anggota Baru
            </a>
            @endif
        </div>
    </div>

    <!-- Filter & Pencarian -->
    <div class="bg-white rounded-lg border border-gray-200 p-4" data-guide="members-filters">
        <form method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1 relative">
                <label for="search" class="sr-only">Cari anggota</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari nama, ID anggota, NIM, atau email..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                >
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>

            <div class="sm:w-44">
                <label for="status" class="sr-only">Filter status</label>
                <select
                    id="status"
                    name="status"
                    onchange="this.form.submit()"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent bg-white"
                >
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Nonaktif" {{ request('status') === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            @if(request()->hasAny(['search', 'status']))
            <a href="{{ route('members.index') }}" class="px-3 py-2 text-gray-600 text-sm font-medium hover:text-gray-900 transition-colors self-center">
                Reset
            </a>
            @endif
        </form>
    </div>

    <!-- Tabel Data Anggota -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden shadow-xs" data-guide="members-table">
        @if ($members->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full text-left" role="table">
                <thead class="bg-gray-50/75 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5">ID Anggota</th>
                        <th class="px-6 py-3.5">Nama & Email</th>
                        <th class="px-6 py-3.5">NIM</th>
                        <th class="px-6 py-3.5">Kelas/Jurusan</th>
                        <th class="px-6 py-3.5">Kontak</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5">Pinjaman Aktif</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @foreach ($members as $member)
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-6 py-3.5 font-mono text-xs font-bold text-gray-900">{{ $member->member_id }}</td>
                        <td class="px-6 py-3.5">
                            <div class="font-semibold text-gray-900">{{ $member->name }}</div>
                            <div class="text-xs text-gray-500">{{ $member->email ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-3.5 text-xs text-gray-700 font-mono">{{ $member->nim ?? '-' }}</td>
                        <td class="px-6 py-3.5 text-xs text-gray-700">{{ $member->class_name ?? '-' }}</td>
                        <td class="px-6 py-3.5 text-xs text-gray-700">{{ $member->phone ?? '-' }}</td>
                        <td class="px-6 py-3.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold
                                {{ $member->status === 'Aktif' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-gray-100 text-gray-600 border border-gray-200' }}">
                                {{ $member->status }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-xs">
                            <span class="font-bold {{ $member->active_loans_count > 0 ? 'text-amber-600' : 'text-gray-500' }}">
                                {{ $member->active_loans_count }} Buku
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('members.edit', $member) }}" class="p-1.5 text-gray-400 hover:text-indigo-600 rounded-lg hover:bg-gray-100 transition-colors" title="Edit Anggota">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('members.destroy', $member) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data anggota ini?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 transition-colors" title="Hapus Anggota">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    @if($member->status === 'Aktif')
                                    <a href="{{ route('loans.create', ['member_id' => $member->id]) }}" class="px-2.5 py-1 rounded bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-semibold transition-colors flex items-center gap-1">
                                        <span>Pinjam</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                    @else
                                    <span class="text-[11px] text-gray-400 italic">Nonaktif</span>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $members->links() }}
        </div>
        @else
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada anggota ditemukan</h3>
            <p class="text-gray-500">Coba ubah filter atau kata kunci pencarian</p>
        </div>
        @endif
    </div>
</div>
@endsection