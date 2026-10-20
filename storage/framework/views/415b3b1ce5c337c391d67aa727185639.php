<?php $__env->startSection('title', 'Katalog Buku'); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-bold text-gray-900">Katalog Buku</h2>
                <?php if(auth()->user()->isAdmin()): ?>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-indigo-100 text-indigo-700 border border-indigo-200">Mode Admin</span>
                <?php else: ?>
                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 border border-emerald-200">Mode Petugas</span>
                <?php endif; ?>
            </div>
            <p class="text-gray-600 mt-1">Kelola dan cari koleksi buku perpustakaan</p>
        </div>

        <div class="flex items-center gap-2">
            <?php if(auth()->user()->isAdmin()): ?>
            <a href="<?php echo e(route('books.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Buku Baru
            </a>
            <?php endif; ?>

            <a href="<?php echo e(route('loans.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors whitespace-nowrap">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Pinjam Buku
            </a>
        </div>
    </div>

    <!-- Filter & Pencarian -->
    <div class="bg-white rounded-lg border border-gray-200 p-4">
        <form method="GET" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1 relative">
                <label for="search" class="sr-only">Cari buku</label>
                <input
                    type="text"
                    id="search"
                    name="search"
                    value="<?php echo e(request('search')); ?>"
                    placeholder="Cari judul, penulis, atau ISBN..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>

            <div class="sm:w-48">
                <label for="category" class="sr-only">Kategori</label>
                <select name="category" id="category" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Kategori</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php echo e(request('category') == $cat->id ? 'selected' : ''); ?>>
                        <?php echo e($cat->name); ?>

                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="sm:w-40">
                <label for="status" class="sr-only">Status</label>
                <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Semua Status</option>
                    <option value="Tersedia" <?php echo e(request('status') === 'Tersedia' ? 'selected' : ''); ?>>Tersedia</option>
                    <option value="Dipinjam" <?php echo e(request('status') === 'Dipinjam' ? 'selected' : ''); ?>>Dipinjam</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors">
                    Filter
                </button>
                <?php if(request()->hasAny(['search', 'category', 'status'])): ?>
                <a href="<?php echo e(route('books.index')); ?>" class="px-4 py-2 text-gray-600 text-sm font-medium hover:text-gray-900 transition-colors">
                    Reset
                </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Grid Koleksi Buku -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <?php if($books->count() > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 p-4">
            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="flex flex-col border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                <div class="aspect-[3/2] bg-gray-100 relative">
                    <?php if($book->cover_url): ?>
                    <img src="<?php echo e($book->cover_url); ?>" alt="<?php echo e($book->title); ?>" class="w-full h-full object-cover">
                    <?php else: ?>
                    <div class="w-full h-full flex items-center justify-center bg-gray-50">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <?php endif; ?>
                    <div class="absolute top-2 right-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold
                            <?php echo e($book->available > 0 ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'); ?>">
                            <?php echo e($book->status); ?>

                        </span>
                    </div>
                </div>
                <div class="p-4 flex-1 flex flex-col justify-between">
                    <div>
                        <h3 class="font-bold text-gray-900 line-clamp-2 text-sm mb-1 leading-snug"><?php echo e($book->title); ?></h3>
                        <p class="text-xs text-gray-500 mb-2"><?php echo e($book->author); ?></p>
                        <div class="flex items-center gap-2 text-xs text-gray-500 mb-3">
                            <?php if($book->category): ?>
                            <span class="px-2 py-0.5 bg-gray-100 rounded text-[11px]"><?php echo e($book->category->name); ?></span>
                            <?php endif; ?>
                            <span class="text-[11px]"><?php echo e($book->year); ?></span>
                        </div>
                    </div>

                    <div class="pt-3 border-t border-gray-100">
                        <div class="flex items-center justify-between text-xs text-gray-600 mb-2.5">
                            <span>Stok: <strong><?php echo e($book->stock); ?></strong></span>
                            <span>Tersedia: <strong class="<?php echo e($book->available > 0 ? 'text-green-600' : 'text-red-500'); ?>"><?php echo e($book->available); ?></strong></span>
                        </div>

                        <div class="flex items-center justify-between gap-1 pt-1">
                            <a href="<?php echo e(route('books.show', $book)); ?>" class="text-xs font-semibold text-primary-600 hover:text-primary-800">
                                Detail &rarr;
                            </a>

                            <?php if(auth()->user()->isAdmin()): ?>
                            <div class="flex items-center gap-1.5">
                                <a href="<?php echo e(route('books.edit', $book)); ?>" class="p-1 text-gray-400 hover:text-indigo-600 transition-colors" title="Edit Buku">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="<?php echo e(route('books.destroy', $book)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?')" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-1 text-gray-400 hover:text-rose-600 transition-colors" title="Hapus Buku">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <?php elseif($book->available > 0): ?>
                            <a href="<?php echo e(route('loans.create', ['book_id' => $book->id])); ?>" class="px-2.5 py-1 rounded bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-xs font-semibold transition-colors flex items-center gap-1">
                                <span>Pinjamkan</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="px-4 py-3 border-t border-gray-200">
            <?php echo e($books->links()); ?>

        </div>
        <?php else: ?>
        <div class="p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-1">Tidak ada buku ditemukan</h3>
            <p class="text-gray-500">Coba ubah filter atau kata kunci pencarian</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\perpustakaan-laravel\resources\views/books/index.blade.php ENDPATH**/ ?>