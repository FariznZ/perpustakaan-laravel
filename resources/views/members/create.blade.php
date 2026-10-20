@extends('layouts.app')

@section('title', 'Tambah Anggota Baru')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2">
                <a href="{{ route('members.index') }}" class="text-xs text-gray-500 hover:text-gray-700">&larr; Kembali ke Data Anggota</a>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mt-1">Tambah Anggota Baru</h2>
            <p class="text-xs text-gray-500">Khusus Administrator &mdash; Daftarkan mahasiswa/civitas sebagai anggota perpustakaan</p>
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

    <form action="{{ route('members.store') }}" method="POST" class="bg-white rounded-xl border border-gray-200 p-6 sm:p-8 space-y-6 shadow-xs" data-guide="member-form">
        @csrf

        <div class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="member_id" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        ID Anggota <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="member_id"
                        id="member_id"
                        required
                        value="{{ old('member_id', $suggestedId) }}"
                        class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-mono"
                    >
                </div>

                <div>
                    <label for="nim" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        NIM / Nomor Induk <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="nim"
                        id="nim"
                        required
                        value="{{ old('nim') }}"
                        placeholder="Contoh: 2024001"
                        class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 font-mono"
                    >
                </div>
            </div>

            <div>
                <label for="name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                    Nama Lengkap <span class="text-rose-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    required
                    value="{{ old('name') }}"
                    placeholder="Nama lengkap anggota"
                    class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                >
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="email" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Alamat Email <span class="text-rose-500">*</span>
                    </label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        required
                        value="{{ old('email') }}"
                        placeholder="anggota@student.ac.id"
                        class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>

                <div>
                    <label for="phone" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Nomor Telepon / WhatsApp
                    </label>
                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone') }}"
                        placeholder="0812xxxxxxxx"
                        class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="class_name" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Kelas / Jurusan
                    </label>
                    <input
                        type="text"
                        name="class_name"
                        id="class_name"
                        value="{{ old('class_name') }}"
                        placeholder="Contoh: TI-3A / Teknik Informatika"
                        class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    >
                </div>

                <div>
                    <label for="status" class="block text-xs font-semibold text-gray-700 uppercase tracking-wider mb-1.5">
                        Status Keanggotaan <span class="text-rose-500">*</span>
                    </label>
                    <select name="status" id="status" required class="w-full px-3.5 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-white">
                        <option value="Aktif" {{ old('status', 'Aktif') === 'Aktif' ? 'selected' : '' }}>Aktif (Dapat Meminjam)</option>
                        <option value="Nonaktif" {{ old('status') === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100" data-guide="member-form-actions">
            <a href="{{ route('members.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">
                Batal
            </a>
            <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                Daftarkan Anggota
            </button>
        </div>
    </form>
</div>
@endsection

