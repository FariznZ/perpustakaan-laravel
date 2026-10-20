@extends('layouts.app')

@section('title', 'Pengembalian')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4" data-guide="returns-header">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Pengembalian Buku</h2>
            <p class="text-gray-600 mt-1">Kelola pengembalian buku yang sedang dipinjam</p>
        </div>
    </div>

    <div class="bg-white rounded-lg border border-gray-200 p-4" data-guide="returns-filters">
        <form method="GET" class="flex gap-4">
            <div class="flex-1 relative max-w-md">
                <label for="search" class="sr-only">Cari</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari judul buku atau nama anggota..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                >
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </form>
    </div>

    <section class="bg-white rounded-lg border border-gray-200" data-guide="returns-active">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    {{ $activeLoans->total() }}
                </span>
                Sedang Dipinjam
            </h3>
        </div>

        @if ($activeLoans->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full" role="table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jatuh Tempo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($activeLoans as $loan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-mono text-gray-900">{{ $loan->loan_code }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $loan->book->title }}</div>
                            <div class="text-sm text-gray-500">{{ $loan->book->author }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $loan->member->name }}</div>
                            <div class="text-sm text-gray-500">{{ $loan->member->member_id }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $loan->loan_date->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $loan->due_date->translatedFormat('d M Y') }}
                            @if ($loan->is_late)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">
                                    Terlambat {{ $loan->days_late }} hari
                                </span>
                            @else
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-700">
                                    Tepat Waktu
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Dipinjam
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <form action="{{ route('loans.return', $loan) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-green-600 bg-green-50 border border-green-200 rounded-lg hover:bg-green-100 hover:border-green-300 transition-colors"
                                    onclick="return confirm('Yakin buku ini sudah dikembalikan?')">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Kembalikan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $activeLoans->links() }}
        </div>
        @else
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada buku yang sedang dipinjam</h3>
            <p class="text-gray-500">Semua buku telah dikembalikan</p>
        </div>
        @endif
    </section>

    <section class="bg-white rounded-lg border border-gray-200 mt-6" data-guide="returns-history">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                    {{ $historyLoans->total() }}
                </span>
                Riwayat Pengembalian
            </h3>
        </div>

        @if ($historyLoans->isNotEmpty())
        <div class="overflow-x-auto">
            <table class="w-full" role="table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Pinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tgl Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Terlambat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($historyLoans as $loan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-mono text-gray-900">{{ $loan->loan_code }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $loan->book->title }}</div>
                            <div class="text-sm text-gray-500">{{ $loan->book->author }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $loan->member->name }}</div>
                            <div class="text-sm text-gray-500">{{ $loan->member->member_id }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $loan->loan_date->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900">{{ $loan->return_date->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Dikembalikan
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            @if ($loan->days_late > 0)
                            <span class="text-red-600 font-medium">{{ $loan->days_late }} hari</span>
                            @else
                            <span class="text-green-600">Tepat waktu</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-3 border-t border-gray-200">
            {{ $historyLoans->links() }}
        </div>
        @else
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada riwayat pengembalian</h3>
            <p class="text-gray-500">Riwayat akan muncul setelah ada buku yang dikembalikan</p>
        </div>
        @endif
    </section>
</div>
@endsection