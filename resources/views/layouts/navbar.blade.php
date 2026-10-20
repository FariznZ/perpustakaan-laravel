<header class="sticky top-0 z-30 bg-white/95 backdrop-blur border-b border-gray-200 shadow-[0_1px_3px_0_rgba(0,0,0,0.02)]">
    <div class="flex items-center justify-between h-16 px-4 md:px-6">
        <div class="flex items-center gap-4">
            <button id="sidebar-toggle" type="button" class="lg:hidden p-2 rounded-lg text-gray-500 hover:text-gray-700 hover:bg-gray-100 transition-colors" aria-label="Buka menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <h1 class="text-lg md:text-xl font-semibold text-gray-900">@yield('title', 'Perpustakaan')</h1>
        </div>

        <div class="flex items-center gap-3 sm:gap-4">
            <div class="hidden md:flex items-center gap-2 text-xs font-medium text-gray-500 bg-gray-100/80 px-3 py-1.5 rounded-full">
                <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>{{ now()->translatedFormat('l, d M Y') }}</span>
            </div>

            @auth
            <div class="relative" id="user-menu-container">
                <button type="button" data-dropdown-toggle="user-dropdown" class="flex items-center gap-2.5 p-1.5 sm:px-3 sm:py-2 rounded-xl text-left hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500/20" aria-expanded="false">
                    @if(auth()->user()->isAdmin())
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-600 to-purple-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    @else
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-emerald-600 to-teal-500 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    @endif
                    <div class="hidden sm:block leading-tight">
                        <div class="text-xs font-bold text-gray-900">{{ auth()->user()->name }}</div>
                        <div class="text-[11px] font-semibold {{ auth()->user()->isAdmin() ? 'text-indigo-600' : 'text-emerald-600' }}">
                            {{ auth()->user()->isAdmin() ? 'Administrator' : 'Petugas' }}
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-60 bg-white rounded-xl shadow-lg border border-gray-100 py-1.5 z-50 animate-fade-in">
                    <div class="px-4 py-2.5 border-b border-gray-100">
                        <p class="text-xs font-bold text-gray-900 truncate">{{ auth()->user()->name }}</p>
                        <p class="text-[11px] text-gray-500 truncate">{{ auth()->user()->email }}</p>
                        <div class="mt-2">
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold {{ auth()->user()->isAdmin() ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-emerald-50 text-emerald-700 border border-emerald-200' }}">
                                @if(auth()->user()->isAdmin())
                                    🛡️ Hak Akses: Administrator
                                @else
                                    💼 Hak Akses: Petugas Sirkulasi
                                @endif
                            </span>
                        </div>
                    </div>

                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('users.index') }}" class="flex items-center gap-2.5 px-4 py-2 text-xs font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        Kelola Akun Staf
                    </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="block w-full border-t border-gray-100 mt-1 pt-1">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-2.5 px-4 py-2 text-xs font-semibold text-rose-600 hover:bg-rose-50 transition-colors text-left">
                            <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                            </svg>
                            Keluar dari Sistem
                        </button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-xs font-semibold shadow-sm transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Masuk
            </a>
            @endauth
        </div>
    </div>
</header>