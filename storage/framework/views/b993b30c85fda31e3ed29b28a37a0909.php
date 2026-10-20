<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    <!-- Role-Based Welcome Banner -->
    <div class="relative overflow-hidden rounded-2xl <?php echo e(auth()->user()->isAdmin() ? 'bg-indigo-800' : 'bg-emerald-800'); ?> text-white p-6 sm:p-8 shadow-sm">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold <?php echo e(auth()->user()->isAdmin() ? 'bg-indigo-400/20 text-indigo-200 border border-indigo-400/30' : 'bg-emerald-400/20 text-emerald-200 border border-emerald-400/30'); ?> mb-3">
                    <?php if(auth()->user()->isAdmin()): ?>
                        <span>🛡️ Mode: Administrator (Hak Akses Penuh)</span>
                    <?php else: ?>
                        <span>💼 Mode: Petugas Sirkulasi (Pelayanan Operasional)</span>
                    <?php endif; ?>
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">
                    Selamat Datang, <?php echo e(auth()->user()->name); ?>!
                </h2>
                <p class="text-sm <?php echo e(auth()->user()->isAdmin() ? 'text-indigo-200' : 'text-emerald-200'); ?> mt-1 max-w-2xl leading-relaxed">
                    <?php if(auth()->user()->isAdmin()): ?>
                        Anda memiliki hak istimewa untuk mengelola katalog buku (tambah, edit, hapus), data anggota, pendaftaran staf petugas, serta rekapitulasi denda.
                    <?php else: ?>
                        Anda bertugas melayani transaksi peminjaman buku, proses pengembalian, pengecekan denda, serta pencarian ketersediaan stok buku untuk peminjam.
                    <?php endif; ?>
                </p>
            </div>

            <!-- Quick Action Buttons Based on Role -->
            <div class="guide-actions flex flex-wrap items-center gap-2.5" data-guide="dashboard-actions">
                <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('books.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-indigo-900 text-xs font-bold hover:bg-indigo-50 shadow-sm transition-all">
                        <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Tambah Buku
                    </a>
                    <a href="<?php echo e(route('members.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur border border-white/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Tambah Anggota
                    </a>
                    <a href="<?php echo e(route('users.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur border border-white/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Kelola Staf
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('loans.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white text-emerald-900 text-xs font-bold hover:bg-emerald-50 shadow-sm transition-all">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Catat Pinjaman Baru
                    </a>
                    <a href="<?php echo e(route('returns.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur border border-white/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Proses Pengembalian
                    </a>
                    <a href="<?php echo e(route('books.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold backdrop-blur border border-white/20 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        Cek Katalog
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Metric Cards -->
    <div class="guide-stats grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" data-guide="dashboard-stats">
        <article class="bg-white rounded-xl border border-gray-200 p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Buku</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 mt-1"><?php echo e($totalBooks); ?></p>
                    <p class="text-[11px] text-gray-400 mt-0.5">Koleksi terdaftar</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-primary-50 text-primary-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
            </div>
        </article>

        <article class="bg-white rounded-xl border border-gray-200 p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Buku Tersedia</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-emerald-600 mt-1"><?php echo e($availableBooks); ?></p>
                    <p class="text-[11px] text-gray-400 mt-0.5">Siap dipinjamkan</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </article>

        <article class="bg-white rounded-xl border border-gray-200 p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Buku Dipinjam</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-amber-600 mt-1"><?php echo e($borrowedBooks); ?></p>
                    <p class="text-[11px] text-gray-400 mt-0.5">Dalam sirkulasi</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </article>

        <article class="bg-white rounded-xl border border-gray-200 p-5 shadow-xs">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Anggota</p>
                    <p class="text-2xl sm:text-3xl font-extrabold text-gray-900 mt-1"><?php echo e($totalMembers); ?></p>
                    <p class="text-[11px] text-gray-400 mt-0.5">Anggota perpustakaan</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
            </div>
        </article>
    </div>

    <!-- Extra Admin or Operational Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <?php if(auth()->user()->isAdmin()): ?>
        <div class="p-4 rounded-xl bg-indigo-50/60 border border-indigo-100 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-indigo-700">Total Denda Terkumpul</span>
                <p class="text-xl font-bold text-indigo-950 mt-0.5">Rp <?php echo e(number_format($totalFines, 0, ',', '.')); ?></p>
            </div>
            <span class="p-2 rounded-lg bg-indigo-100 text-indigo-700">💵</span>
        </div>

        <div class="p-4 rounded-xl bg-purple-50/60 border border-purple-100 flex items-center justify-between">
            <div>
                <span class="text-xs font-semibold text-purple-700">Staf Terdaftar</span>
                <p class="text-xl font-bold text-purple-950 mt-0.5"><?php echo e($totalStaff); ?> Akun Pengguna</p>
            </div>
            <a href="<?php echo e(route('users.index')); ?>" class="text-xs font-semibold text-purple-700 hover:underline">Kelola &rarr;</a>
        </div>
        <?php endif; ?>

        <div class="p-4 rounded-xl <?php echo e($overdueCount > 0 ? 'bg-rose-50/70 border border-rose-200' : 'bg-gray-50 border border-gray-200'); ?> flex items-center justify-between <?php echo e(auth()->user()->isPetugas() ? 'sm:col-span-3' : ''); ?>">
            <div>
                <span class="text-xs font-semibold <?php echo e($overdueCount > 0 ? 'text-rose-700' : 'text-gray-600'); ?>">Pinjaman Terlambat (Jatuh Tempo)</span>
                <p class="text-xl font-bold <?php echo e($overdueCount > 0 ? 'text-rose-800' : 'text-gray-900'); ?> mt-0.5"><?php echo e($overdueCount); ?> Transaksi</p>
            </div>
            <?php if($overdueCount > 0): ?>
                <a href="<?php echo e(route('returns.index')); ?>" class="px-3 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-xs">
                    Tindak Lanjut &rarr;
                </a>
            <?php else: ?>
                <span class="text-xs text-gray-500 font-medium">Semua lancar</span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Active Loans Table -->
    <section class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden" data-guide="dashboard-loans">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-gray-900">Sirkulasi Pinjaman Berjalan</h3>
                <p class="text-xs text-gray-500 mt-0.5">Daftar buku yang saat ini sedang dibawa anggota</p>
            </div>
            <a href="<?php echo e(route('loans.index')); ?>" class="text-xs text-primary-600 hover:text-primary-700 font-bold">
                Lihat Semua Sirkulasi &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left" role="table">
                <thead class="bg-gray-50/75 border-b border-gray-200 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3">Kode Pinjam</th>
                        <th class="px-6 py-3">Judul Buku</th>
                        <th class="px-6 py-3">Peminjam</th>
                        <th class="px-6 py-3">Tgl Pinjam</th>
                        <th class="px-6 py-3">Batas Waktu</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $activeLoans->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50/70 transition-colors">
                        <td class="px-6 py-3.5 font-mono text-xs font-bold text-gray-800"><?php echo e($loan->loan_code); ?></td>
                        <td class="px-6 py-3.5">
                            <div class="font-semibold text-gray-900"><?php echo e($loan->book->title); ?></div>
                            <div class="text-xs text-gray-500"><?php echo e($loan->book->author); ?></div>
                        </td>
                        <td class="px-6 py-3.5">
                            <div class="font-medium text-gray-900"><?php echo e($loan->member->name); ?></div>
                            <div class="text-xs text-gray-500"><?php echo e($loan->member->member_id); ?> &bull; <?php echo e($loan->member->class_name); ?></div>
                        </td>
                        <td class="px-6 py-3.5 text-xs text-gray-600"><?php echo e($loan->loan_date->translatedFormat('d M Y')); ?></td>
                        <td class="px-6 py-3.5 text-xs">
                            <span class="font-medium text-gray-800"><?php echo e($loan->due_date->translatedFormat('d M Y')); ?></span>
                            <?php if($loan->is_late): ?>
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-rose-100 text-rose-700">
                                    Telat <?php echo e($loan->days_late); ?> Hari
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-3.5">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                Dipinjam
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-right">
                            <a href="<?php echo e(route('returns.index', ['search' => $loan->loan_code])); ?>" class="inline-flex items-center gap-1 text-xs font-bold text-primary-600 hover:text-primary-800">
                                <span>Kembalikan</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                            <p class="text-sm">Saat ini tidak ada transaksi peminjaman aktif.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/alll/Dokumen/perpustakaan-laravel/resources/views/dashboard/index.blade.php ENDPATH**/ ?>