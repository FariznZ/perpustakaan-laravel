<!DOCTYPE html>
<html lang="id" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk ke Akun | Sistem Perpustakaan</title>
    
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', system-ui, sans-serif; }
        .bg-grid-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.12) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>
</head>
<body class="h-full text-gray-900 antialiased selection:bg-primary-500 selection:text-white">
    <div class="min-h-screen flex">
        
        <!-- Left Side: Hero / Brand Showcase (Desktop) -->
        <div class="hidden lg:flex lg:w-1/2 relative bg-gradient-to-br from-primary-950 via-primary-900 to-primary-800 p-12 flex-col justify-between overflow-hidden text-white">
            <!-- Ambient Glow & Pattern -->
            <div class="absolute inset-0 bg-grid-pattern opacity-40 pointer-events-none"></div>
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-sky-400/20 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Top Brand -->
            <div class="relative z-10 flex items-center gap-3">
                <div class="w-11 h-11 rounded-2xl bg-white/10 backdrop-blur-md border border-white/20 flex items-center justify-center shadow-inner">
                    <svg class="w-6 h-6 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold tracking-tight text-white leading-none">Perpustakaan</h1>
                    <span class="text-xs text-primary-200 font-medium">Digital Management System</span>
                </div>
            </div>

            <!-- Center Showcase -->
            <div class="relative z-10 my-auto py-12 max-w-lg">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 backdrop-blur-sm border border-white/15 text-xs font-medium text-sky-200 mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Sistem Operasional Aktif
                </div>

                <h2 class="text-3xl xl:text-4xl font-extrabold tracking-tight leading-tight text-white mb-4">
                    Kelola Sirkulasi Buku dengan Cepat, Akurat & Terpadu.
                </h2>
                <p class="text-base text-primary-200/90 leading-relaxed mb-8">
                    Portal terpadu untuk pencatatan katalog buku, keanggotaan aktif, transaksi peminjaman hingga rekonsiliasi denda secara real-time.
                </p>

                <!-- Feature Mini Cards -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 hover:bg-white/10 transition-colors">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-8 h-8 rounded-lg bg-sky-400/20 text-sky-300 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-white">Katalog Lengkap</span>
                        </div>
                        <p class="text-xs text-primary-200/80">Koleksi buku terorganisir per kategori & ISBN</p>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 hover:bg-white/10 transition-colors">
                        <div class="flex items-center gap-3 mb-1">
                            <div class="w-8 h-8 rounded-lg bg-emerald-400/20 text-emerald-300 flex items-center justify-center">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <span class="text-xs font-semibold text-white">Otomasi Denda</span>
                        </div>
                        <p class="text-xs text-primary-200/80">Kalkulasi keterlambatan otomatis dan transparan</p>
                    </div>
                </div>
            </div>

            <!-- Bottom Note -->
            <div class="relative z-10 flex items-center justify-between text-xs text-primary-300/80 pt-6 border-t border-white/10">
                <span>&copy; {{ date('Y') }} Sistem Perpustakaan. All rights reserved.</span>
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    Koneksi Terenkripsi & Aman
                </span>
            </div>
        </div>

        <!-- Right Side: Login Form Panel -->
        <div class="w-full lg:w-1/2 flex flex-col justify-between p-6 sm:p-10 lg:p-14 bg-white overflow-y-auto">
            
            <!-- Mobile Brand Header -->
            <div class="flex items-center justify-between lg:hidden pb-6 border-b border-gray-100 mb-6">
                <div class="flex items-center gap-2.5">
                    <div class="w-9 h-9 rounded-xl bg-primary-600 text-white flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <span class="text-base font-bold text-gray-900 block leading-tight">Perpustakaan</span>
                        <span class="text-[11px] text-gray-500 font-medium">Digital System</span>
                    </div>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-semibold bg-primary-50 text-primary-700">v1.0</span>
            </div>

            <!-- Form Container -->
            <div class="max-w-md w-full mx-auto my-auto py-6">
                
                <!-- Heading -->
                <div class="mb-8">
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900 tracking-tight">
                        Selamat Datang Kembali
                    </h2>
                    <p class="mt-2 text-sm text-gray-500">
                        Masuk ke akun Anda untuk mengelola sistem perpustakaan.
                    </p>
                </div>

                <!-- Flash Alert Messages -->
                @if (session('success'))
                <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                @if ($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-rose-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <p class="font-medium">{{ $error }}</p>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Demo Account Fast-Fill Pill Box -->
                <div class="mb-6 p-4 rounded-2xl bg-gradient-to-r from-primary-50 via-sky-50 to-indigo-50 border border-primary-100">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-semibold text-primary-900 flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Klik untuk Isi Akun Demo:
                        </span>
                        <span class="text-[10px] uppercase font-bold text-primary-600 bg-white px-2 py-0.5 rounded-full shadow-xs border border-primary-200">1-Klik</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <button type="button" onclick="fillCredentials('admin@perpustakaan.test', 'password')" class="px-3 py-2 bg-white hover:bg-primary-600 hover:text-white border border-primary-200 rounded-xl text-left transition-all duration-150 group shadow-xs">
                            <span class="text-xs font-bold text-gray-800 group-hover:text-white block">Administrator</span>
                            <span class="text-[11px] text-gray-500 group-hover:text-sky-100 block truncate">admin@perpustakaan.test</span>
                        </button>
                        <button type="button" onclick="fillCredentials('petugas@perpustakaan.test', 'password')" class="px-3 py-2 bg-white hover:bg-primary-600 hover:text-white border border-primary-200 rounded-xl text-left transition-all duration-150 group shadow-xs">
                            <span class="text-xs font-bold text-gray-800 group-hover:text-white block">Petugas</span>
                            <span class="text-[11px] text-gray-500 group-hover:text-sky-100 block truncate">petugas@perpustakaan.test</span>
                        </button>
                    </div>
                </div>

                <!-- Main Login Form -->
                <form action="{{ route('login.post') }}" method="POST" class="space-y-5" id="loginForm">
                    @csrf

                    <!-- Email Input -->
                    <div>
                        <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-gray-700 mb-2">
                            Alamat Email
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206"/>
                                </svg>
                            </div>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                placeholder="nama@perpustakaan.test"
                                class="w-full pl-11 pr-4 py-3 bg-gray-50/50 hover:bg-white focus:bg-white border {{ $errors->has('email') ? 'border-rose-400 focus:ring-rose-200' : 'border-gray-200 focus:border-primary-500 focus:ring-primary-100' }} rounded-xl text-sm text-gray-900 placeholder-gray-400 transition-all focus:outline-none focus:ring-4"
                            >
                        </div>
                    </div>

                    <!-- Password Input -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-gray-700">
                                Kata Sandi
                            </label>
                            <span class="text-xs text-primary-600 hover:text-primary-700 font-medium cursor-pointer" onclick="alert('Untuk uji coba, Anda dapat menggunakan tombol Akun Demo di atas dengan password: password')">
                                Lupa sandi?
                            </span>
                        </div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                required
                                autocomplete="current-password"
                                placeholder="••••••••"
                                class="w-full pl-11 pr-11 py-3 bg-gray-50/50 hover:bg-white focus:bg-white border {{ $errors->has('password') ? 'border-rose-400 focus:ring-rose-200' : 'border-gray-200 focus:border-primary-500 focus:ring-primary-100' }} rounded-xl text-sm text-gray-900 placeholder-gray-400 transition-all focus:outline-none focus:ring-4"
                            >
                            <button
                                type="button"
                                id="togglePasswordBtn"
                                onclick="togglePasswordVisibility()"
                                class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
                                aria-label="Lihat kata sandi"
                            >
                                <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <svg id="eyeSlashIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2.5 cursor-pointer select-none">
                            <input
                                type="checkbox"
                                name="remember"
                                id="remember"
                                class="w-4 h-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 focus:ring-offset-0 transition-colors"
                            >
                            <span class="text-xs font-medium text-gray-600">Ingat sesi saya</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        id="submitBtn"
                        class="w-full flex items-center justify-center gap-2 py-3 px-4 bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-500 hover:to-primary-600 active:scale-[0.99] text-white font-semibold text-sm rounded-xl shadow-lg shadow-primary-500/25 transition-all duration-150 focus:outline-none focus:ring-4 focus:ring-primary-200 cursor-pointer"
                    >
                        <span>Masuk ke Sistem</span>
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </button>
                </form>

                <!-- Help Info -->
                <div class="mt-8 pt-6 border-t border-gray-100 flex items-center justify-center gap-2 text-xs text-gray-500">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Butuh akses akun baru? Hubungi <strong class="text-gray-700 font-semibold">Kepala Perpustakaan</strong></span>
                </div>
            </div>

            <!-- Footer -->
            <div class="text-center text-xs text-gray-400 mt-6 pt-4">
                Sistem Informasi Perpustakaan &bull; Versi 1.0.0
                <span class="mx-2 text-gray-300">|</span>
                <a href="{{ route('presentation') }}" class="font-semibold text-primary-600 transition hover:text-primary-700">
                    Lihat Presentasi
                </a>
            </div>
        </div>
    </div>

    <!-- Script for Dynamic Password Toggle & Fast Credentials Fill -->
    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }

        function fillCredentials(email, password) {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const submitBtn = document.getElementById('submitBtn');

            emailInput.value = email;
            passwordInput.value = password;

            // Highlight animation
            emailInput.classList.add('ring-4', 'ring-primary-200');
            passwordInput.classList.add('ring-4', 'ring-primary-200');
            setTimeout(() => {
                emailInput.classList.remove('ring-4', 'ring-primary-200');
                passwordInput.classList.remove('ring-4', 'ring-primary-200');
            }, 600);

            submitBtn.focus();
        }

        document.getElementById('loginForm')?.addEventListener('submit', function() {
            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.classList.add('opacity-80', 'cursor-not-allowed');
            btn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Memproses...</span>
            `;
        });
    </script>
</body>
</html>

