<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-white border-r border-gray-200 transform transition-transform duration-200 ease-in-out lg:sticky lg:top-0 lg:bottom-auto lg:h-screen lg:transform-none lg:z-auto" aria-label="Navigasi utama">
    <div class="flex flex-col h-full overflow-hidden">
        <div class="flex items-center justify-between h-16 flex-shrink-0 px-4 border-b border-gray-200">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 text-primary-700 font-bold text-lg">
                <div class="w-8 h-8 rounded-lg bg-primary-600 text-white flex items-center justify-center shadow-xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span>Perpustakaan</span>
            </a>
            <button id="sidebar-toggle" type="button" class="lg:hidden p-2 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-100" aria-label="Tutup sidebar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <nav class="flex-1 min-h-0 p-4 space-y-1 overflow-y-auto overscroll-contain" aria-label="Menu navigasi">
            <div class="px-3 pb-1 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Menu Utama</div>

            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('books.index') }}" class="{{ request()->routeIs('books.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Katalog Buku
            </a>

            <a href="{{ route('members.index') }}" class="{{ request()->routeIs('members.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Data Anggota
            </a>

            <div class="pt-4 px-3 pb-1 text-[11px] font-bold text-gray-400 uppercase tracking-wider">Sirkulasi</div>

            <a href="{{ route('loans.index') }}" class="{{ request()->routeIs('loans.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                </svg>
                Peminjaman
            </a>

            <a href="{{ route('returns.index') }}" class="{{ request()->routeIs('returns.*') ? 'bg-primary-50 text-primary-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Pengembalian
            </a>

            @if(auth()->check() && auth()->user()->isAdmin())
            <div class="pt-4 px-3 pb-1 text-[11px] font-bold text-indigo-400 uppercase tracking-wider flex items-center justify-between">
                <span>Administrasi</span>
                <span class="text-[9px] bg-indigo-100 text-indigo-700 px-1.5 py-0.5 rounded font-bold">Admin</span>
            </div>

            <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }} flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm transition-colors">
                <svg class="w-5 h-5 flex-shrink-0 {{ request()->routeIs('users.*') ? 'text-indigo-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Kelola Staf & Petugas
            </a>
            @endif
        </nav>

        <div class="flex-shrink-0 p-3 border-t border-gray-200 bg-gray-50/50">
            @auth
            <div class="p-2.5 rounded-xl bg-white border border-gray-200 shadow-xs mb-2">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5 min-w-0">
                        @if(auth()->user()->isAdmin())
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-700 to-purple-600 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 shadow-xs">
                            🛡️
                        </div>
                        @else
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold text-xs flex items-center justify-center flex-shrink-0 shadow-xs">
                            💼
                        </div>
                        @endif
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-gray-900 truncate leading-tight">{{ auth()->user()->name }}</p>
                            <span class="inline-block mt-0.5 text-[10px] font-semibold px-1.5 py-0.2 rounded {{ auth()->user()->isAdmin() ? 'bg-indigo-100 text-indigo-700' : 'bg-emerald-100 text-emerald-800' }}">
                                {{ auth()->user()->isAdmin() ? 'Administrator' : 'Petugas Sirkulasi' }}
                            </span>
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST" class="flex-shrink-0">
                        @csrf
                        <button type="submit" title="Keluar" class="p-1.5 text-gray-400 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @endauth
            <p class="text-[10px] text-gray-400 text-center">&copy; {{ date('Y') }} Sistem Perpustakaan</p>
        </div>
    </div>
</aside>

<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-black/50 hidden lg:hidden" aria-hidden="true"></div>