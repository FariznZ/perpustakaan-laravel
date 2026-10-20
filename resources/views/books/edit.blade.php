@extends('layouts.app')

@section('title', 'Edit Buku: ' . $book->title)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('books.show', $book) }}" class="text-xs text-gray-500 hover:text-gray-700">&larr; Kembali ke Detail Buku</a>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">Edit Data Buku</h2>
            <p class="text-xs text-gray-500">Khusus Administrator &mdash; Perbarui informasi katalog buku</p>
        </div>
    </div>

    @if ($errors->any())
    <div class="p-4 bg-rose-50 border border-rose-200 rounded-xl text-rose-800 text-sm">
        <p class="font-bold mb-1">Periksa kembali isian formulir:</p>
        <ul class="list-disc list-inside text-xs space-y-0.5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('books.update', $book) }}" method="POST" class="bg-white rounded-xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-xs">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="sm:col-span-2">
                <label for="title" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Judul Buku <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    name="title"
                    id="title"
                    required
                    value="{{ old('title', $book->title) }}"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label for="author" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Nama Penulis / Pengarang <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    name="author"
                    id="author"
                    required
                    value="{{ old('author', $book->author) }}"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label for="publisher" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Penerbit
                </label>
                <input
                    type="text"
                    name="publisher"
                    id="publisher"
                    value="{{ old('publisher', $book->publisher) }}"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label for="category_id" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Kategori Buku
                </label>
                <select name="category_id" id="category_id" class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="isbn" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Nomor ISBN
                </label>
                <input
                    type="text"
                    name="isbn"
                    id="isbn"
                    value="{{ old('isbn', $book->isbn) }}"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-mono"
                >
            </div>

            <div>
                <label for="year" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Tahun Terbit
                </label>
                <input
                    type="number"
                    name="year"
                    id="year"
                    value="{{ old('year', $book->year) }}"
                    min="1900"
                    max="{{ date('Y') + 1 }}"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label for="pages" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Jumlah Halaman
                </label>
                <input
                    type="number"
                    name="pages"
                    id="pages"
                    value="{{ old('pages', $book->pages) }}"
                    min="1"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label for="stock" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Jumlah Eksemplar / Stok <span class="text-rose-500">*</span>
                </label>
                <input
                    type="number"
                    name="stock"
                    id="stock"
                    required
                    value="{{ old('stock', $book->stock) }}"
                    min="1"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div>
                <label for="cover_url" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    URL Gambar Cover
                </label>
                <input
                    type="url"
                    name="cover_url"
                    id="cover_url"
                    value="{{ old('cover_url', $book->cover_url) }}"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div class="sm:col-span-2">
                <label for="description" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Sinopsis / Deskripsi Buku
                </label>
                <textarea
                    name="description"
                    id="description"
                    rows="3"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >{{ old('description', $book->description) }}</textarea>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
            <a href="{{ route('books.show', $book) }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection

