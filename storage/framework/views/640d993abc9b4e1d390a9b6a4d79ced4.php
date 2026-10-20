<header class="sticky top-0 z-30 bg-white/95 backdrop-blur border-b border-gray-200 shadow-[0_1px_3px_0_rgba(0,0,0,0.02)]">
    <div class="flex items-center justify-between h-16 px-4 md:px-6">
        <div class="flex items-center gap-4">
            <button id="sidebar-toggle" type="button" class="lg:hidden p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-colors" aria-label="Buka menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-lg md:text-xl font-semibold text-gray-900"><?php echo $__env->yieldContent('title', 'Perpustakaan'); ?></h1>
        </div>

        <div class="flex items-center gap-2 sm:gap-4">
            <button type="button" data-guide-start class="inline-flex items-center gap-2 px-2.5 sm:px-3 py-2 rounded-xl text-xs font-semibold text-gray-600 hover:text-primary-700 hover:bg-primary-50 border border-transparent hover:border-primary-100 transition-colors" aria-label="Buka panduan penggunaan" title="Panduan">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 1.734-2 3.272-2 1.933 0 3.5 1.343 3.5 3 0 1.657-1.567 3-3.5 3-.6 0-1.164.132-1.657.365M12 17h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="hidden sm:inline">Panduan</span>
            </button>

            <div class="hidden md:flex items-center gap-2 text-xs font-medium text-gray-500 bg-gray-100/80 px-3 py-1.5 rounded-full">
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span><?php echo e(now()->translatedFormat('l, d M Y')); ?></span>
            </div>

            <?php if(auth()->guard()->check()): ?>
            <div class="relative" id="user-menu-container">
                <button type="button" data-dropdown-toggle="user-dropdown" class="flex items-center gap-2.5 p-1.5 sm:px-3 sm:py-2 rounded-xl text-left hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500/20" aria-expanded="false">
                    <?php if(auth()->user()->isAdmin()): ?>
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

                    </div>
                    <?php else: ?>
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                        <?php echo e(strtoupper(substr(auth()->user()->name, 0, 2))); ?>

                    </div>
                    <?php endif; ?>
                    <div class="hidden sm:block leading-tight">
                        <div class="text-xs font-bold text-gray-900"><?php echo e(auth()->user()->name); ?></div>
                        <div class="text-[11px] font-semibold <?php echo e(auth()->user()->isAdmin() ? 'text-indigo-600' : 'text-emerald-600'); ?>">
                            <?php echo e(auth()->user()->isAdmin() ? 'Administrator' : 'Petugas'); ?>

                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-60 bg-white rounded-xl shadow-lg border border-gray-100 py-1.5 z-50 animate-fade-in">
                    <div class="px-4 py-2.5 border-b border-gray-100">
                        <p class="text-xs font-bold text-gray-900 truncate"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-[11px] text-gray-500 truncate"><?php echo e(auth()->user()->email); ?></p>
                        <div class="mt-2">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold <?php echo e(auth()->user()->isAdmin() ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200'); ?>">
                                <?php if(auth()->user()->isAdmin()): ?>
                                    🛡️ Hak Akses: Administrator
                                <?php else: ?>
                                    💼 Hak Akses: Petugas Sirkulasi
                                <?php endif; ?>
                            </span>
                        </div>
                    </div>

                    <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('users.index')); ?>" class="flex items-center gap-2.5 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Kelola Akun Staf
                    </a>
                    <?php endif; ?>

                    <form action="<?php echo e(route('logout')); ?>" method="POST" class="block w-full border-t border-gray-100 mt-1 pt-1">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors text-left">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar dari Sistem
                        </button>
                    </form>
                </div>
            </div>
            <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk
            </a>
            <?php endif; ?>
        </div>
    </div>
</header><?php /**PATH /home/alll/Dokumen/perpustakaan-laravel/resources/views/layouts/navbar.blade.php ENDPATH**/ ?>