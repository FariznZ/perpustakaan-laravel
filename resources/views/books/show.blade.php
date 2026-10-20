@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('books.index') }}" class="text-sm text-gray-500 hover:text-gray-700 mb-2 inline-block">&larr; Kembali ke Katalog</a>
            <h2 class="text-2xl font-bold text-gray-900">{{ $book->title }}</h2>
        <div class="flex items-center gap-2 flex-wrap" data-guide="book-header-actions">
            @if(auth()->user()->isAdmin())
            <a href="{{ route('books.edit', $book) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-gray-300 text-xs font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Buku
            </a>
            <form action="{{ route('books.destroy', $book) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg border border-rose-200 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors">
                    <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Hapus
                </button>
            </form>
            @endif

            @if($book->available > 0)
            <a href="{{ route('loans.create', ['book_id' => $book->id]) }}" class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-xs transition-colors">
                ⚡ Pinjamkan Buku
            </a>
            @endif

            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                {{ $book->available > 0 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                {{ $book->status }}
            </span>
        </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden" data-guide="book-meta">
                <div class="aspect-[3/4] bg-gray-100 relative">
                    @if ($book->cover_url)
                    <img src="{{ $book->cover_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    @endif
                </div>

                <div class="p-4 border-t border-gray-200 space-y-3">
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</dt>
                        <dd class="text-lg font-semibold text-gray-900">{{ $book->stock }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tersedia</dt>
                        <dd class="text-lg font-semibold text-gray-900">{{ $book->available }}</dd>
                    </div>
                    @if ($book->isbn)
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">ISBN</dt>
                        <dd class="text-sm font-mono text-gray-900">{{ $book->isbn }}</dd>
                    </div>
                    @endif
                    @if ($book->pages)
                    <div>
                        <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Halaman</dt>
                        <dd class="text-sm text-gray-900">{{ $book->pages }}</dd>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-6">
            <section class="bg-white rounded-lg border border-gray-200 p-6" data-guide="book-info">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Buku</h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Penulis</dt>
                        <dd class="mt-1 text-gray-900">{{ $book->author }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Penerbit</dt>
                        <dd class="mt-1 text-gray-900">{{ $book->publisher ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Tahun Terbit</dt>
                        <dd class="mt-1 text-gray-900">{{ $book->year ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Kategori</dt>
                        <dd class="mt-1 text-gray-900">{{ $book->category->name ?? '-' }}</dd>
                    </div>
                </dl>
            </section>

            @if ($book->description)
            <section class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi</h3>
                <div class="prose prose-sm max-w-none text-gray-700">
                    {{ nl2br(e($book->description)) }}
                </div>
            </section>
            @endif

            @if ($book->available > 0)
            <section class="bg-white rounded-lg border border-gray-200 p-6" data-guide="book-loan-form">
                <form action="{{ route('loans.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <h3 class="text-lg font-semibold text-gray-900">Pinjam Buku Ini</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="member_id" class="block text-sm font-medium text-gray-700 mb-1">Anggota <span class="text-red-500">*</span></label>
                            <select name="member_id" id="member_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <option value="">Pilih Anggota</option>
                                @foreach (\App\Models\Member::where('status', 'Aktif')->orderBy('name')->get() as $member)
                                <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->member_id }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="loan_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pinjam <span class="text-red-500">*</span></label>
                            <input type="date" name="loan_date" id="loan_date" required value="{{ now()->format('Y-m-d') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                        <div>
                            <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Jatuh Tempo <span class="text-red-500">*</span></label>
                            <input type="date" name="due_date" id="due_date" required value="{{ now()->addDays(7)->format('Y-m-d') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                    </div>
                    <button type="submit"
                        class="w-full sm:w-auto px-6 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                        Pinjam Buku
                    </button>
                </form>
            </section>
            @else
            <section class="bg-white rounded-lg border border-gray-200 p-6">
                <div class="flex items-center gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <p class="font-medium text-yellow-800">Buku sedang dipinjam</p>
                        <p class="text-sm text-yellow-700">Tidak tersedia untuk dipinjam saat ini. Silakan cek halaman pengembalian.</p>
                    </div>
                </div>
            </section>
            @endif

            @if ($activeLoan)
            <section class="bg-white rounded-lg border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Peminjaman Aktif</h3>
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="font-medium text-gray-500">Peminjam</dt>
                        <dd class="text-gray-900">{{ $activeLoan->member->name }} ({{ $activeLoan->member->member_id }})</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Tanggal Pinjam</dt>
                        <dd class="text-gray-900">{{ $activeLoan->loan_date->translatedFormat('d M Y') }}</dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Jatuh Tempo</dt>
                        <dd class="text-gray-900 {{ $activeLoan->is_late ? 'text-red-600 font-medium' : '' }}">
                            {{ $activeLoan->due_date->translatedFormat('d M Y') }}
                            @if ($activeLoan->is_late)
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-700">
                                Terlambat {{ $activeLoan->days_late }} hari
                            </span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="font-medium text-gray-500">Kode Pinjam</dt>
                        <dd class="text-gray-900 font-mono">{{ $activeLoan->loan_code }}</dd>
                    </div>
                </dl>
            </section>
            @endif
        </div>
    </div>
</div>
@endsection