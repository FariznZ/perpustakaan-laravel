<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presentasi Project | Sistem Perpustakaan</title>
    <meta name="description" content="Presentasi interaktif Sistem Perpustakaan Laravel: fitur, alur kerja, teknologi, database, dan keamanan.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff', 100: '#e0f2fe', 200: '#bae6fd', 300: '#7dd3fc',
                            400: '#38bdf8', 500: '#0ea5e9', 600: '#0284c7', 700: '#0369a1',
                            800: '#075985', 900: '#0c4a6e', 950: '#082f49',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                },
            },
        };
    </script>

    <style>
        :root {
            --accent: #38bdf8;
            --accent-2: #818cf8;
        }

        * { font-family: 'Inter', system-ui, sans-serif; }

        html, body { height: 100%; }

        body {
            background:
                radial-gradient(circle at 15% 15%, rgba(14, 165, 233, 0.16), transparent 34%),
                radial-gradient(circle at 85% 20%, rgba(129, 140, 248, 0.14), transparent 32%),
                radial-gradient(circle at 50% 100%, rgba(16, 185, 129, 0.10), transparent 38%),
                #020617;
            color: #e2e8f0;
            overflow: hidden;
        }

        .bg-grid {
            background-image:
                linear-gradient(rgba(148, 163, 184, 0.055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(148, 163, 184, 0.055) 1px, transparent 1px);
            background-size: 56px 56px;
            mask-image: radial-gradient(ellipse at center, black 30%, transparent 78%);
        }

        .gradient-text {
            background: linear-gradient(110deg, #7dd3fc 0%, #38bdf8 32%, #a5b4fc 65%, #f0abfc 100%);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .glass {
            background: rgba(15, 23, 42, 0.58);
            border: 1px solid rgba(148, 163, 184, 0.14);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
        }

        .glass-strong {
            background: rgba(15, 23, 42, 0.78);
            border: 1px solid rgba(148, 163, 184, 0.18);
            backdrop-filter: blur(22px);
            -webkit-backdrop-filter: blur(22px);
        }

        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(26px) scale(0.985);
            transition: opacity 0.55s cubic-bezier(0.22, 1, 0.36, 1), transform 0.55s cubic-bezier(0.22, 1, 0.36, 1), visibility 0.55s;
            pointer-events: none;
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: thin;
            scrollbar-color: rgba(56, 189, 248, 0.35) transparent;
        }

        .slide::-webkit-scrollbar { width: 8px; }
        .slide::-webkit-scrollbar-thumb { background: rgba(56, 189, 248, 0.28); border-radius: 99px; }

        .slide.is-active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
            pointer-events: auto;
            z-index: 2;
        }

        .slide.is-prev { transform: translateY(-22px) scale(0.985); }

        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1), transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
            transition-delay: calc(var(--delay, 0) * 85ms);
        }

        .slide.is-active .reveal {
            opacity: 1;
            transform: translateY(0);
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(0.92);
            transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1), transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
            transition-delay: calc(var(--delay, 0) * 85ms);
        }

        .slide.is-active .reveal-scale {
            opacity: 1;
            transform: scale(1);
        }

        .orb {
            position: absolute;
            border-radius: 9999px;
            filter: blur(42px);
            opacity: 0.55;
            animation: float 9s ease-in-out infinite alternate;
            pointer-events: none;
        }

        @keyframes float {
            0% { transform: translate3d(0, 0, 0) scale(1); }
            100% { transform: translate3d(0, -22px, 0) scale(1.06); }
        }

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(56, 189, 248, 0.35); }
            70% { box-shadow: 0 0 0 14px rgba(56, 189, 248, 0); }
            100% { box-shadow: 0 0 0 0 rgba(56, 189, 248, 0); }
        }

        .pulse-dot { animation: pulse-ring 2.2s infinite; }

        .feature-card {
            transition: transform 0.3s ease, border-color 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            border-color: rgba(56, 189, 248, 0.35);
            background: rgba(15, 23, 42, 0.82);
            box-shadow: 0 18px 50px -20px rgba(14, 165, 233, 0.45);
        }

        .timeline-line {
            background: linear-gradient(180deg, rgba(56, 189, 248, 0.8), rgba(129, 140, 248, 0.45), rgba(16, 185, 129, 0.25));
        }

        .progress-bar {
            background: linear-gradient(90deg, #38bdf8, #818cf8, #34d399);
            transition: width 0.45s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .dots button {
            transition: all 0.25s ease;
        }

        .dots button.is-active {
            width: 28px;
            background: linear-gradient(90deg, #38bdf8, #818cf8);
        }

        .code-line { display: block; }
        .code-line::before { content: attr(data-line); color: #475569; display: inline-block; width: 2.5rem; }

        .animate-delay-1 { animation-delay: 0.5s; }
        .animate-delay-2 { animation-delay: 1s; }

        .auto-play.is-on {
            color: #34d399;
            border-color: rgba(52, 211, 153, 0.45);
            background: rgba(16, 185, 129, 0.12);
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
            .share-link { display: none; }
        }

        @media (max-width: 640px) {
            .slide { scrollbar-width: none; }
            .slide::-webkit-scrollbar { display: none; }
        }
    </style>
</head>
<body class="min-h-screen antialiased selection:bg-primary-500 selection:text-white">

    <div id="presentation" class="relative h-[100dvh] w-full overflow-hidden">
        <div class="bg-grid absolute inset-0 pointer-events-none"></div>

        <!-- Ambient background -->
        <div class="orb -left-24 top-10 h-72 w-72 bg-primary-500/25"></div>
        <div class="orb -right-20 top-1/3 h-80 w-80 bg-indigo-500/20" style="animation-delay: -3s;"></div>
        <div class="orb bottom-0 left-1/3 h-64 w-64 bg-emerald-500/15" style="animation-delay: -6s;"></div>

        <!-- Top bar -->
        <header class="fixed inset-x-0 top-0 z-50">
            <div class="h-1 w-full bg-white/5">
                <div id="progressBar" class="progress-bar h-full w-0"></div>
            </div>

            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
                <a href="{{ route('presentation') }}" class="flex items-center gap-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-br from-primary-500 to-indigo-500 shadow-lg shadow-primary-500/20">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div class="leading-tight">
                        <p class="text-sm font-bold text-white">Sistem Perpustakaan</p>
                        <p class="text-[10px] font-medium uppercase tracking-[0.18em] text-slate-400">Project Presentation</p>
                    </div>
                </a>

                <div class="flex items-center gap-2 sm:gap-3">
                    <div class="hidden items-center gap-2 rounded-full glass px-3 py-1.5 sm:flex">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 pulse-dot"></span>
                        <span class="text-[11px] font-semibold text-slate-300">Live Demo</span>
                    </div>

                    <a href="{{ route('login') }}" class="hidden items-center gap-2 rounded-xl bg-white px-3.5 py-2 text-xs font-bold text-slate-900 transition hover:bg-primary-50 sm:inline-flex">
                        Buka Aplikasi
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>

                    <button id="fullscreenButton" type="button" class="flex h-9 w-9 items-center justify-center rounded-xl glass text-slate-300 transition hover:text-white" aria-label="Mode layar penuh" title="Layar penuh (F)">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 3H5a2 2 0 00-2 2v3m13-5h3a2 2 0 012 2v3M8 21H5a2 2 0 01-2-2v-3m13 5h3a2 2 0 002-2v-3"/>
                        </svg>
                    </button>
                </div>
            </div>
        </header>

        <main id="slides" class="relative h-full">

            <!-- 01 · COVER -->
            <section class="slide" data-slide="0" aria-label="Slide 1: Pembuka">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="grid items-center gap-12 lg:grid-cols-[1.1fr_0.9fr]">
                        <div>
                            <div class="reveal inline-flex items-center gap-2 rounded-full glass px-3.5 py-1.5 text-[11px] font-bold uppercase tracking-[0.18em] text-primary-200">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-400 pulse-dot"></span>
                                Interactive Project Deck
                            </div>

                            <h1 class="reveal mt-6 text-5xl font-black leading-[0.95] tracking-tight text-white sm:text-6xl lg:text-7xl" style="--delay: 1;">
                                Sistem<br>
                                <span class="gradient-text">Perpustakaan</span>
                            </h1>

                            <p class="reveal mt-5 max-w-xl text-base leading-relaxed text-slate-400 sm:text-lg" style="--delay: 2;">
                                Aplikasi manajemen perpustakaan modern untuk katalog buku, keanggotaan, sirkulasi peminjaman, pengembalian, denda, dan pengelolaan staf — dalam satu dashboard yang bersih dan responsif.
                            </p>

                            <div class="reveal mt-8 flex flex-wrap items-center gap-3" style="--delay: 3;">
                                <button type="button" data-next class="group inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-indigo-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-primary-500/25 transition hover:from-primary-400 hover:to-indigo-400">
                                    Mulai Presentasi
                                    <svg class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </button>
                                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl glass px-5 py-3 text-sm font-semibold text-slate-200 transition hover:border-primary-400/40 hover:text-white">
                                    Buka Aplikasi
                                </a>
                            </div>

                            <div class="reveal mt-8 flex flex-wrap gap-2" style="--delay: 4;">
                                @foreach (['Laravel 11', 'PHP 8.5', 'MySQL / MariaDB', 'Tailwind CSS', 'Vite'] as $tech)
                                    <span class="rounded-lg border border-white/10 bg-white/5 px-2.5 py-1 text-[11px] font-semibold text-slate-300">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </div>

                        <div class="relative hidden min-h-[420px] lg:block">
                            <div class="reveal-scale absolute right-0 top-0 w-64 rounded-2xl glass-strong p-5 shadow-2xl" style="--delay: 2;">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Total Koleksi</span>
                                    <span class="rounded-md bg-primary-500/15 px-1.5 py-0.5 text-[9px] font-bold text-primary-300">REAL-TIME</span>
                                </div>
                                <div class="mt-3 flex items-end gap-2">
                                    <span class="text-4xl font-black text-white">10</span>
                                    <span class="mb-1 text-xs font-semibold text-slate-400">buku</span>
                                </div>
                                <div class="mt-4 h-1.5 overflow-hidden rounded-full bg-white/10">
                                    <div class="h-full w-4/5 rounded-full bg-gradient-to-r from-primary-400 to-indigo-400"></div>
                                </div>
                                <p class="mt-2 text-[10px] text-slate-500">Stok tersedia: 29 eksemplar</p>
                            </div>

                            <div class="reveal-scale absolute bottom-0 right-4 w-64 rounded-2xl glass-strong p-5 shadow-2xl" style="--delay: 3;">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500/15 text-lg">📚</div>
                                    <div>
                                        <p class="text-xs font-bold text-white">Sirkulasi Aktif</p>
                                        <p class="text-[10px] text-slate-400">Pantau jatuh tempo & denda</p>
                                    </div>
                                </div>
                                <div class="mt-4 flex items-center justify-between rounded-xl bg-white/5 px-3 py-2">
                                    <span class="text-[10px] text-slate-400">Status sistem</span>
                                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold text-emerald-300">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> Aktif
                                    </span>
                                </div>
                            </div>

                            <div class="reveal-scale absolute left-0 top-40 w-52 rounded-2xl border border-indigo-400/20 bg-indigo-500/10 p-4 backdrop-blur-xl" style="--delay: 4;">
                                <p class="text-[10px] font-bold uppercase tracking-wider text-indigo-200">Role-Based Access</p>
                                <p class="mt-2 text-xs leading-relaxed text-slate-300">Admin & Petugas punya hak akses yang berbeda.</p>
                            </div>
                        </div>
                    </div>

                    <div class="reveal mt-12 flex items-center gap-3 text-[11px] font-medium text-slate-500" style="--delay: 5;">
                        <span class="inline-flex items-center gap-1.5">
                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                            Gunakan tombol panah, spasi, atau klik untuk berpindah slide
                        </span>
                    </div>
                </div>
            </section>

            <!-- 02 · OVERVIEW -->
            <section class="slide" data-slide="1" aria-label="Slide 2: Ringkasan project">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="reveal">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-primary-400">01 · Ringkasan</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">Satu sistem untuk seluruh <span class="gradient-text">operasional perpustakaan</span>.</h2>
                        <p class="mt-4 max-w-3xl text-sm leading-relaxed text-slate-400 sm:text-base">
                            Project ini menggantikan pencatatan manual dengan alur digital yang terintegrasi: katalog buku, data anggota, transaksi peminjaman, pengembalian, perhitungan denda, hingga manajemen akun staf. Semua data tersimpan rapi di database dan disajikan lewat dashboard yang mudah dipahami.
                        </p>
                    </div>

                    <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ([
                            ['value' => 10, 'suffix' => '', 'label' => 'Buku Terdaftar', 'icon' => '📚', 'color' => 'primary'],
                            ['value' => 8, 'suffix' => '', 'label' => 'Kategori', 'icon' => '🗂️', 'color' => 'indigo'],
                            ['value' => 5, 'suffix' => '', 'label' => 'Anggota', 'icon' => '👥', 'color' => 'emerald'],
                            ['value' => 2, 'suffix' => '', 'label' => 'Peran Pengguna', 'icon' => '🛡️', 'color' => 'amber'],
                        ] as $stat)
                            <div class="reveal-scale feature-card rounded-2xl glass p-5" style="--delay: {{ $loop->index + 1 }};">
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl">{{ $stat['icon'] }}</span>
                                    <span class="text-[9px] font-bold uppercase tracking-wider text-slate-500">Data Seed</span>
                                </div>
                                <p class="mt-4 flex items-end gap-1">
                                    <span class="counter text-4xl font-black text-white" data-counter="{{ $stat['value'] }}">0</span>
                                    <span class="mb-1 text-xs font-semibold text-slate-400">{{ $stat['suffix'] }}</span>
                                </p>
                                <p class="mt-1 text-xs font-medium text-slate-400">{{ $stat['label'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 grid gap-4 lg:grid-cols-3">
                        @foreach ([
                            ['icon' => '🎯', 'title' => 'Tujuan', 'text' => 'Mempercepat pekerjaan harian pustakawan dan mengurangi kesalahan pencatatan manual.'],
                            ['icon' => '⚡', 'title' => 'Nilai Utama', 'text' => 'Data stok dan status peminjaman selalu terbarui, denda dihitung otomatis, dan akses staf terkontrol.'],
                            ['icon' => '🧩', 'title' => 'Pendekatan', 'text' => 'Dibangun dengan Laravel MVC, database relasional, Blade + Tailwind, serta panduan interaktif per halaman.'],
                        ] as $item)
                            <div class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-5" style="--delay: {{ $loop->index + 5 }};">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/5 text-lg">{{ $item['icon'] }}</span>
                                    <h3 class="text-sm font-bold text-white">{{ $item['title'] }}</h3>
                                </div>
                                <p class="mt-3 text-xs leading-relaxed text-slate-400">{{ $item['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- 03 · FEATURES 1 -->
            <section class="slide" data-slide="2" aria-label="Slide 3: Fitur inti">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
                        <div class="reveal">
                            <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-primary-400">02 · Fitur Inti</p>
                            <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">Semua yang dibutuhkan untuk <span class="gradient-text">mengelola koleksi</span>.</h2>
                        </div>
                        <span class="reveal rounded-full border border-primary-400/20 bg-primary-500/10 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-primary-300" style="--delay: 1;">6 modul utama</span>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ([
                            ['icon' => '📊', 'title' => 'Dashboard & Statistik', 'text' => 'Ringkasan total buku, stok tersedia, buku dipinjam, total anggota, total denda, dan jumlah staf dalam satu layar.', 'tag' => 'Realtime'],
                            ['icon' => '📚', 'title' => 'Katalog Buku', 'text' => 'Grid koleksi dengan cover, judul, penulis, kategori, status ketersediaan, stok, dan ISBN. Mendukung tampilan kartu yang responsif.', 'tag' => 'CRUD'],
                            ['icon' => '🔎', 'title' => 'Pencarian & Filter', 'text' => 'Cari berdasarkan judul, penulis, atau ISBN. Filter kategori dan status ketersediaan untuk menemukan buku lebih cepat.', 'tag' => 'Filter'],
                            ['icon' => '📘', 'title' => 'Detail Buku', 'text' => 'Halaman detail berisi metadata lengkap, stok, deskripsi, dan form peminjaman langsung dengan buku yang sudah terpilih.', 'tag' => 'Detail'],
                            ['icon' => '👥', 'title' => 'Data Anggota', 'text' => 'Kelola identitas anggota, NIM, kelas/jurusan, kontak, status aktif/nonaktif, serta jumlah pinjaman aktif.', 'tag' => 'CRUD'],
                            ['icon' => '🔄', 'title' => 'Peminjaman', 'text' => 'Catat transaksi dengan memilih buku dan anggota, atur tanggal pinjam dan jatuh tempo, lalu simpan dengan validasi stok.', 'tag' => 'Sirkulasi'],
                        ] as $feature)
                            <article class="reveal feature-card rounded-2xl glass p-5" style="--delay: {{ ($loop->index % 3) + 1 }};">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/5 text-xl">{{ $feature['icon'] }}</div>
                                    <span class="rounded-md border border-white/10 bg-white/5 px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider text-slate-400">{{ $feature['tag'] }}</span>
                                </div>
                                <h3 class="mt-4 text-sm font-bold text-white">{{ $feature['title'] }}</h3>
                                <p class="mt-2 text-xs leading-relaxed text-slate-400">{{ $feature['text'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- 04 · FEATURES 2 -->
            <section class="slide" data-slide="3" aria-label="Slide 4: Fitur lanjutan">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="reveal">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-emerald-400">03 · Fitur Lanjutan</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">Bukan cuma CRUD — ada <span class="gradient-text">otomasi dan kontrol akses</span>.</h2>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ([
                            ['icon' => '↩️', 'title' => 'Pengembalian Buku', 'text' => 'Proses pengembalian dari daftar pinjaman aktif. Stok kembali otomatis dan transaksi masuk ke riwayat.', 'accent' => 'emerald'],
                            ['icon' => '⏰', 'title' => 'Deteksi Keterlambatan', 'text' => 'Sistem membandingkan tanggal jatuh tempo dengan tanggal kembali, lalu menghitung jumlah hari terlambat.', 'accent' => 'amber'],
                            ['icon' => '💰', 'title' => 'Perhitungan Denda', 'text' => 'Denda dihitung otomatis berdasarkan keterlambatan, sehingga rekapitulasi tidak perlu dilakukan manual.', 'accent' => 'rose'],
                            ['icon' => '🛡️', 'title' => 'Role-Based Access', 'text' => 'Middleware admin membatasi penambahan, pengeditan, dan penghapusan buku serta pengelolaan akun staf.', 'accent' => 'indigo'],
                            ['icon' => '👔', 'title' => 'Manajemen Staf', 'text' => 'Admin dapat membuat akun Administrator atau Petugas, memfilter daftar staf, dan menghapus akun yang tidak diperlukan.', 'accent' => 'sky'],
                            ['icon' => '🧭', 'title' => 'Panduan Interaktif', 'text' => 'Tour per halaman menampilkan fitur penting satu kali secara otomatis. Setelah itu bisa dibuka lagi lewat tombol Panduan.', 'accent' => 'violet'],
                        ] as $feature)
                            <article class="reveal feature-card rounded-2xl glass p-5" style="--delay: {{ ($loop->index % 3) + 1 }};">
                                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-{{ $feature['accent'] }}-500/10 text-xl">{{ $feature['icon'] }}</div>
                                <h3 class="mt-4 text-sm font-bold text-white">{{ $feature['title'] }}</h3>
                                <p class="mt-2 text-xs leading-relaxed text-slate-400">{{ $feature['text'] }}</p>
                            </article>
                        @endforeach
                    </div>

                    <div class="reveal mt-6 flex flex-wrap items-center gap-3 rounded-2xl border border-emerald-400/20 bg-emerald-500/[0.06] p-4" style="--delay: 4;">
                        <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-emerald-500/15 text-base">✅</span>
                        <p class="text-xs leading-relaxed text-emerald-100/80">
                            <strong class="font-bold text-emerald-200">Tambahan:</strong> UI responsif mobile-first, navigasi keyboard, label form yang benar, serta penanganan error validasi yang jelas.
                        </p>
                    </div>
                </div>
            </section>

            <!-- 05 · WORKFLOW -->
            <section class="slide" data-slide="4" aria-label="Slide 5: Alur sirkulasi">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="reveal">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-primary-400">04 · Alur Kerja</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">Dari rak buku sampai <span class="gradient-text">kembali ke rak</span>.</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-400">Alur sirkulasi dibuat sederhana agar petugas bisa melayani anggota dengan cepat dan akurat.</p>
                    </div>

                    <div class="mt-10 grid gap-5 lg:grid-cols-[1fr_0.72fr]">
                        <div class="relative">
                            <div class="timeline-line absolute bottom-5 left-[19px] top-5 w-px"></div>

                            <div class="space-y-4">
                                @foreach ([
                                    ['step' => '01', 'title' => 'Pilih buku & anggota', 'text' => 'Cari buku yang tersedia, lalu pilih anggota aktif yang akan meminjam.'],
                                    ['step' => '02', 'title' => 'Catat peminjaman', 'text' => 'Tentukan tanggal pinjam dan jatuh tempo. Sistem membuat kode pinjam dan mengurangi stok.'],
                                    ['step' => '03', 'title' => 'Pantau jatuh tempo', 'text' => 'Dashboard dan tabel peminjaman menampilkan transaksi aktif serta status keterlambatan.'],
                                    ['step' => '04', 'title' => 'Proses pengembalian', 'text' => 'Petugas mengembalikan buku dari halaman pengembalian; stok bertambah otomatis.'],
                                    ['step' => '05', 'title' => 'Denda & riwayat', 'text' => 'Jika terlambat, denda dihitung otomatis dan transaksi tersimpan di riwayat pengembalian.'],
                                ] as $step)
                                    <div class="reveal relative flex gap-4 rounded-2xl border border-white/10 bg-white/[0.025] p-4 pl-5 transition hover:border-primary-400/30 hover:bg-white/[0.045]" style="--delay: {{ $loop->index + 1 }};">
                                        <div class="relative z-10 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-primary-400/25 bg-slate-950 text-[10px] font-black text-primary-300">{{ $step['step'] }}</div>
                                        <div>
                                            <h3 class="text-sm font-bold text-white">{{ $step['title'] }}</h3>
                                            <p class="mt-1 text-xs leading-relaxed text-slate-400">{{ $step['text'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="reveal-scale rounded-3xl glass-strong p-5" style="--delay: 3;">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Contoh Transaksi</p>
                                    <p class="mt-1 font-mono text-sm font-bold text-white">PJ-001</p>
                                </div>
                                <span class="rounded-full bg-amber-500/15 px-2.5 py-1 text-[10px] font-bold text-amber-300">Dipinjam</span>
                            </div>

                            <div class="mt-5 space-y-3">
                                <div class="rounded-xl bg-white/5 p-3">
                                    <p class="text-[10px] uppercase tracking-wider text-slate-500">Buku</p>
                                    <p class="mt-0.5 text-xs font-semibold text-white">Laravel: Up &amp; Running</p>
                                    <p class="text-[10px] text-slate-400">Matt Stauffer</p>
                                </div>
                                <div class="rounded-xl bg-white/5 p-3">
                                    <p class="text-[10px] uppercase tracking-wider text-slate-500">Anggota</p>
                                    <p class="mt-0.5 text-xs font-semibold text-white">Ahmad Santoso</p>
                                    <p class="text-[10px] text-slate-400">ANG001 · TI-2A</p>
                                </div>
                                <div class="grid grid-cols-2 gap-3">
                                    <div class="rounded-xl bg-white/5 p-3">
                                        <p class="text-[10px] uppercase tracking-wider text-slate-500">Pinjam</p>
                                        <p class="mt-0.5 text-xs font-semibold text-white">20 Okt 2026</p>
                                    </div>
                                    <div class="rounded-xl bg-white/5 p-3">
                                        <p class="text-[10px] uppercase tracking-wider text-slate-500">Jatuh Tempo</p>
                                        <p class="mt-0.5 text-xs font-semibold text-white">27 Okt 2026</p>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 flex items-center gap-2 rounded-xl border border-primary-400/20 bg-primary-500/10 p-3">
                                <span class="text-base">💡</span>
                                <p class="text-[10px] leading-relaxed text-primary-100/80">Stok berkurang saat dipinjam dan kembali otomatis saat dikembalikan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 06 · ROLES -->
            <section class="slide" data-slide="5" aria-label="Slide 6: Peran pengguna">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="reveal">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-indigo-400">05 · Hak Akses</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">Dua peran, <span class="gradient-text">satu sistem yang aman</span>.</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-400">Menu dan aksi menyesuaikan peran pengguna. Middleware admin memastikan hanya Administrator yang bisa mengubah data master dan akun staf.</p>
                    </div>

                    <div class="mt-8 grid gap-5 lg:grid-cols-2">
                        <div class="reveal rounded-3xl border border-indigo-400/25 bg-indigo-500/[0.07] p-6" style="--delay: 1;">
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-500 text-2xl shadow-lg shadow-indigo-500/20">🛡️</div>
                                <div>
                                    <h3 class="text-lg font-black text-white">Administrator</h3>
                                    <p class="text-xs text-indigo-200/70">Akses penuh ke seluruh modul</p>
                                </div>
                            </div>

                            <div class="mt-6 space-y-2.5">
                                @foreach ([
                                    'Melihat dashboard dan seluruh statistik',
                                    'Menambah, mengedit, dan menghapus buku',
                                    'Mengelola data anggota',
                                    'Membuat dan memproses peminjaman',
                                    'Memproses pengembalian dan denda',
                                    'Mengelola akun staf & peran pengguna',
                                ] as $item)
                                    <div class="flex items-start gap-2.5 text-xs text-indigo-50/85">
                                        <span class="mt-0.5 flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full bg-indigo-400/20 text-[9px] text-indigo-200">✓</span>
                                        {{ $item }}
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="reveal rounded-3xl border border-emerald-400/25 bg-emerald-500/[0.06] p-6" style="--delay: 2;">
                            <div class="flex items-center gap-4">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-500 text-2xl shadow-lg shadow-emerald-500/20">💼</div>
                                <div>
                                    <h3 class="text-lg font-black text-white">Petugas Sirkulasi</h3>
                                    <p class="text-xs text-emerald-200/70">Fokus pada pelayanan operasional</p>
                                </div>
                            </div>

                            <div class="mt-6 space-y-2.5">
                                @foreach ([
                                    'Melihat dashboard dan statistik',
                                    'Melihat katalog dan detail buku',
                                    'Mencari dan memfilter koleksi',
                                    'Membuat transaksi peminjaman',
                                    'Memproses pengembalian buku',
                                    'Melihat daftar dan status anggota',
                                ] as $item)
                                    <div class="flex items-start gap-2.5 text-xs text-emerald-50/85">
                                        <span class="mt-0.5 flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full bg-emerald-400/20 text-[9px] text-emerald-200">✓</span>
                                        {{ $item }}
                                    </div>
                                @endforeach
                            </div>

                            <div class="mt-5 rounded-xl border border-emerald-400/15 bg-slate-950/25 p-3 text-[10px] leading-relaxed text-emerald-100/65">
                                Tidak dapat menambah/mengedit/menghapus buku atau mengelola akun staf.
                            </div>
                        </div>
                    </div>

                    <div class="reveal mt-5 flex items-center gap-3 rounded-2xl border border-white/10 bg-white/[0.03] p-4" style="--delay: 3;">
                        <span class="rounded-lg bg-indigo-500/15 px-2.5 py-1 font-mono text-[10px] font-bold text-indigo-300">middleware('admin')</span>
                        <p class="text-xs text-slate-400">Diterapkan pada route buku (create/edit/delete), anggota (create/edit/delete), dan manajemen staf.</p>
                    </div>
                </div>
            </section>

            <!-- 07 · TECH STACK -->
            <section class="slide" data-slide="6" aria-label="Slide 7: Teknologi">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="reveal">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-primary-400">06 · Teknologi</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">Stack yang <span class="gradient-text">modern, stabil, dan teruji</span>.</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-400">Dibangun dengan ekosistem Laravel dan tools yang umum digunakan di industri, sehingga mudah dikembangkan dan di-deploy.</p>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ([
                            ['icon' => '⚙️', 'title' => 'Backend', 'color' => 'rose', 'items' => ['Laravel 11.57', 'PHP 8.5', 'Eloquent ORM', 'Laravel Sanctum', 'Laravel Tinker']],
                            ['icon' => '🎨', 'title' => 'Frontend', 'color' => 'primary', 'items' => ['Blade Templates', 'Tailwind CSS', 'Vite 5', 'Vanilla JavaScript', 'Google Fonts Inter']],
                            ['icon' => '🗄️', 'title' => 'Database', 'color' => 'emerald', 'items' => ['MySQL / MariaDB 13', 'Migrations', 'Seeders & Factories', 'Relasi Eloquent', 'Query Builder']],
                            ['icon' => '🚀', 'title' => 'Infrastruktur', 'color' => 'indigo', 'items' => ['Nginx 1.30', 'PHP-FPM', 'Composer 2.10', 'npm / Node 26', 'phpMyAdmin']],
                        ] as $group)
                            <div class="reveal feature-card rounded-2xl glass p-5" style="--delay: {{ $loop->index + 1 }};">
                                <div class="flex items-center gap-3">
                                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-{{ $group['color'] }}-500/10 text-lg">{{ $group['icon'] }}</span>
                                    <h3 class="text-sm font-bold text-white">{{ $group['title'] }}</h3>
                                </div>
                                <div class="mt-4 flex flex-wrap gap-1.5">
                                    @foreach ($group['items'] as $item)
                                        <span class="rounded-md border border-white/10 bg-white/5 px-2 py-1 text-[10px] font-semibold text-slate-300">{{ $item }}</span>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 grid gap-4 lg:grid-cols-[1fr_1fr]">
                        <div class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-5" style="--delay: 5;">
                            <h3 class="text-sm font-bold text-white">Arsitektur MVC</h3>
                            <div class="mt-4 flex flex-wrap items-center gap-2 text-[10px] font-semibold">
                                <span class="rounded-lg bg-primary-500/15 px-3 py-2 text-primary-200">Route</span>
                                <span class="text-slate-600">→</span>
                                <span class="rounded-lg bg-indigo-500/15 px-3 py-2 text-indigo-200">Controller</span>
                                <span class="text-slate-600">→</span>
                                <span class="rounded-lg bg-emerald-500/15 px-3 py-2 text-emerald-200">Model / Eloquent</span>
                                <span class="text-slate-600">→</span>
                                <span class="rounded-lg bg-amber-500/15 px-3 py-2 text-amber-200">Blade View</span>
                            </div>
                            <p class="mt-4 text-xs leading-relaxed text-slate-400">Request masuk melalui route, diproses controller bersama model, lalu dirender ke view. Validasi dan otorisasi berjalan di lapisan controller/middleware.</p>
                        </div>

                        <div class="reveal rounded-2xl border border-white/10 bg-white/[0.03] p-5" style="--delay: 6;">
                            <h3 class="text-sm font-bold text-white">Kualitas & Pengujian</h3>
                            <div class="mt-4 rounded-xl bg-slate-950/70 p-4 font-mono text-[10px] leading-relaxed text-slate-300 ring-1 ring-white/10">
                                <span class="code-line" data-line="1">$ php artisan test</span>
                                <span class="code-line text-emerald-300" data-line="2">PASS  Tests\Feature\AuthTest</span>
                                <span class="code-line text-emerald-300" data-line="3">PASS  Tests\Feature\DashboardTest</span>
                                <span class="code-line text-emerald-300" data-line="4">PASS  Tests\Feature\RolePermissionTest</span>
                                <span class="code-line text-slate-400" data-line="5">Tests: 8 · Assertions: 33</span>
                            </div>
                            <p class="mt-3 text-[10px] leading-relaxed text-slate-500">PHPUnit 11 untuk memastikan autentikasi, dashboard, dan pembatasan role tetap berjalan.</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- 08 · DATABASE -->
            <section class="slide" data-slide="7" aria-label="Slide 8: Database">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="reveal">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-emerald-400">07 · Database</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">Struktur data yang <span class="gradient-text">saling terhubung</span>.</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-relaxed text-slate-400">Database relasional dengan foreign key dan relasi Eloquent. Migrasi dan seeder memudahkan setup ulang di environment baru.</p>
                    </div>

                    <div class="mt-8 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ([
                            ['name' => 'categories', 'icon' => '🗂️', 'fields' => ['id', 'name', 'slug', 'description'], 'relation' => '1 → N books'],
                            ['name' => 'books', 'icon' => '📚', 'fields' => ['id', 'title', 'author', 'isbn', 'category_id', 'stock'], 'relation' => 'N → 1 categories'],
                            ['name' => 'members', 'icon' => '👥', 'fields' => ['id', 'member_id', 'name', 'nim', 'status'], 'relation' => '1 → N loans'],
                            ['name' => 'loans', 'icon' => '🔄', 'fields' => ['id', 'loan_code', 'book_id', 'member_id', 'due_date', 'return_date', 'fine'], 'relation' => 'N → 1 books & members'],
                            ['name' => 'users', 'icon' => '🛡️', 'fields' => ['id', 'name', 'email', 'password', 'role'], 'relation' => '1 → N guide progress'],
                            ['name' => 'user_guide_progress', 'icon' => '🧭', 'fields' => ['id', 'user_id', 'page_key', 'seen_at'], 'relation' => 'N → 1 users'],
                        ] as $table)
                            <div class="reveal feature-card rounded-2xl glass p-4" style="--delay: {{ $loop->index % 3 + 1 }};">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="text-base">{{ $table['icon'] }}</span>
                                        <code class="text-xs font-bold text-white">{{ $table['name'] }}</code>
                                    </div>
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span>
                                </div>
                                <div class="mt-3 flex flex-wrap gap-1">
                                    @foreach ($table['fields'] as $field)
                                        <span class="rounded bg-white/5 px-1.5 py-0.5 font-mono text-[9px] text-slate-400">{{ $field }}</span>
                                    @endforeach
                                </div>
                                <p class="mt-3 text-[10px] font-semibold text-primary-300/80">{{ $table['relation'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="reveal mt-5 flex flex-wrap items-center gap-2 text-[10px] text-slate-500" style="--delay: 4;">
                        <span class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1">Foreign key constraints</span>
                        <span class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1">Cascade delete untuk progress panduan</span>
                        <span class="rounded-full border border-white/10 bg-white/5 px-2.5 py-1">Seeder data awal: 8 kategori, 10 buku, 5 anggota</span>
                    </div>
                </div>
            </section>

            <!-- 09 · QUALITY -->
            <section class="slide" data-slide="8" aria-label="Slide 9: Keamanan dan kualitas">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col justify-center px-5 pb-24 pt-24 sm:px-8 lg:px-10">
                    <div class="reveal">
                        <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-amber-400">08 · Keamanan & Kualitas</p>
                        <h2 class="mt-2 text-3xl font-black tracking-tight text-white sm:text-4xl lg:text-5xl">Aman, tervalidasi, dan <span class="gradient-text">nyaman digunakan</span>.</h2>
                    </div>

                    <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ([
                            ['icon' => '🔐', 'title' => 'Autentikasi', 'text' => 'Login session Laravel, password di-hash, dan fitur logout yang membersihkan session.'],
                            ['icon' => '🛡️', 'title' => 'CSRF Protection', 'text' => 'Setiap form dilindungi token CSRF. Request POST/PUT/DELETE wajib menyertakan token.'],
                            ['icon' => '🚦', 'title' => 'Role Middleware', 'text' => 'Akses admin dibatasi di level route, bukan hanya menyembunyikan tombol di UI.'],
                            ['icon' => '✅', 'title' => 'Validasi Input', 'text' => 'Data buku, anggota, dan peminjaman divalidasi sebelum disimpan ke database.'],
                            ['icon' => '📱', 'title' => 'Responsif', 'text' => 'Layout mobile-first dengan sidebar yang bisa dibuka-tutup dan tabel yang dapat digeser.'],
                            ['icon' => '⌨️', 'title' => 'Aksesibilitas', 'text' => 'Label form, aria-label, navigasi keyboard, dan kontras warna yang memadai.'],
                            ['icon' => '🧪', 'title' => 'Automated Test', 'text' => 'Feature test untuk autentikasi, dashboard, dan pembatasan akses berdasarkan role.'],
                            ['icon' => '🧭', 'title' => 'User Guide', 'text' => 'Panduan interaktif per halaman muncul sekali, lalu bisa dibuka ulang dari navbar.'],
                        ] as $item)
                            <div class="reveal feature-card rounded-2xl glass p-4" style="--delay: {{ $loop->index % 4 + 1 }};">
                                <span class="text-xl">{{ $item['icon'] }}</span>
                                <h3 class="mt-3 text-xs font-bold text-white">{{ $item['title'] }}</h3>
                                <p class="mt-1.5 text-[11px] leading-relaxed text-slate-400">{{ $item['text'] }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="reveal mt-6 grid gap-3 sm:grid-cols-3" style="--delay: 5;">
                        @foreach ([
                            ['value' => '8', 'label' => 'Feature Test'],
                            ['value' => '33', 'label' => 'Assertion'],
                            ['value' => '100%', 'label' => 'Form Terproteksi CSRF'],
                        ] as $stat)
                            <div class="flex items-center justify-between rounded-xl border border-white/10 bg-white/[0.03] px-4 py-3">
                                <span class="text-2xl font-black text-white">{{ $stat['value'] }}</span>
                                <span class="text-[10px] font-semibold uppercase tracking-wider text-slate-500">{{ $stat['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- 10 · CLOSING -->
            <section class="slide" data-slide="9" aria-label="Slide 10: Penutup">
                <div class="mx-auto flex min-h-full max-w-7xl flex-col items-center justify-center px-5 pb-24 pt-24 text-center sm:px-8">
                    <div class="reveal-scale flex h-20 w-20 items-center justify-center rounded-3xl bg-gradient-to-br from-primary-500 to-indigo-500 text-4xl shadow-2xl shadow-primary-500/25">
                        📚
                    </div>
                    <p class="reveal mt-6 text-[11px] font-bold uppercase tracking-[0.22em] text-primary-400" style="--delay: 1;">Terima kasih</p>
                    <h2 class="reveal mt-3 max-w-3xl text-4xl font-black leading-tight tracking-tight text-white sm:text-5xl lg:text-6xl" style="--delay: 2;">
                        Sistem Perpustakaan<br><span class="gradient-text">siap digunakan.</span>
                    </h2>
                    <p class="reveal mt-5 max-w-2xl text-sm leading-relaxed text-slate-400 sm:text-base" style="--delay: 3;">
                        Katalog yang rapi, sirkulasi yang cepat, denda yang transparan, dan akses staf yang terkontrol — semuanya dalam satu aplikasi Laravel yang ringan dan mudah dikembangkan.
                    </p>

                    <div class="reveal mt-8 flex flex-wrap items-center justify-center gap-3" style="--delay: 4;">
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-primary-500 to-indigo-500 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-primary-500/25 transition hover:from-primary-400 hover:to-indigo-400">
                            Buka Aplikasi
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                        <button type="button" data-restart class="inline-flex items-center gap-2 rounded-xl glass px-5 py-3 text-sm font-semibold text-slate-200 transition hover:border-primary-400/40 hover:text-white">
                            Ulangi Presentasi
                        </button>
                    </div>

                    <div class="reveal mt-10 flex flex-wrap items-center justify-center gap-2 text-[10px] font-semibold text-slate-500" style="--delay: 5;">
                        <span>Laravel 11</span><span class="text-slate-700">•</span>
                        <span>PHP 8.5</span><span class="text-slate-700">•</span>
                        <span>MySQL / MariaDB</span><span class="text-slate-700">•</span>
                        <span>Tailwind CSS</span><span class="text-slate-700">•</span>
                        <span>Vite</span><span class="text-slate-700">•</span>
                        <span>Nginx</span>
                    </div>

                    <p class="mt-8 text-[10px] text-slate-600">&copy; {{ date('Y') }} Sistem Perpustakaan. Dibangun dengan Laravel.</p>
                </div>
            </section>
        </main>

        <!-- Bottom controls -->
        <footer class="pointer-events-none fixed inset-x-0 bottom-0 z-50">
            <div class="mx-auto flex max-w-7xl items-end justify-between gap-4 px-4 pb-4 sm:px-6 lg:px-8">
                <div class="pointer-events-auto flex items-center gap-2">
                    <button id="prevButton" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl glass text-slate-300 transition hover:text-white disabled:cursor-not-allowed disabled:opacity-30" aria-label="Slide sebelumnya">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button id="nextButton" type="button" class="flex h-10 w-10 items-center justify-center rounded-xl bg-white text-slate-900 transition hover:bg-primary-50 disabled:cursor-not-allowed disabled:opacity-30" aria-label="Slide berikutnya">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>

                <div class="pointer-events-auto hidden items-center gap-3 md:flex">
                    <div id="dots" class="dots flex items-center gap-1.5 rounded-full glass px-3 py-2"></div>
                    <span id="slideCounter" class="rounded-full glass px-3 py-2 text-[10px] font-bold tabular-nums text-slate-300">01 / 10</span>
                </div>

                <div class="pointer-events-auto flex items-center gap-2">
                    <button id="autoPlayButton" type="button" class="auto-play inline-flex items-center gap-1.5 rounded-xl border border-white/10 bg-white/5 px-3 py-2 text-[10px] font-bold text-slate-400 transition hover:text-white" title="Putar otomatis">
                        <span id="autoPlayDot" class="h-1.5 w-1.5 rounded-full bg-slate-500"></span>
                        AUTO
                    </button>
                    <span id="mobileCounter" class="rounded-full glass px-3 py-2 text-[10px] font-bold tabular-nums text-slate-300 md:hidden">01 / 10</span>
                </div>
            </div>
        </footer>
    </div>

    <script>
        (function () {
            const slides = Array.from(document.querySelectorAll('.slide'));
            const progressBar = document.getElementById('progressBar');
            const dotsContainer = document.getElementById('dots');
            const slideCounter = document.getElementById('slideCounter');
            const mobileCounter = document.getElementById('mobileCounter');
            const prevButton = document.getElementById('prevButton');
            const nextButton = document.getElementById('nextButton');
            const autoPlayButton = document.getElementById('autoPlayButton');
            const autoPlayDot = document.getElementById('autoPlayDot');
            const fullscreenButton = document.getElementById('fullscreenButton');

            let current = 0;
            let autoPlayTimer = null;
            let isAutoPlaying = false;
            let touchStartX = 0;

            const pad = (number) => String(number).padStart(2, '0');

            function buildDots() {
                dotsContainer.innerHTML = '';

                slides.forEach((_, index) => {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'h-1.5 w-1.5 rounded-full bg-white/20 hover:bg-white/50';
                    dot.setAttribute('aria-label', 'Ke slide ' + (index + 1));
                    dot.addEventListener('click', () => {
                        stopAutoPlay();
                        goTo(index);
                    });
                    dotsContainer.appendChild(dot);
                });
            }

            function updateDots() {
                Array.from(dotsContainer.children).forEach((dot, index) => {
                    dot.classList.toggle('is-active', index === current);
                });
            }

            function animateCounters(slide) {
                slide.querySelectorAll('[data-counter]').forEach((counter) => {
                    const target = Number(counter.dataset.counter);
                    const duration = 900;
                    const start = performance.now();

                    function tick(now) {
                        const progress = Math.min((now - start) / duration, 1);
                        const eased = 1 - Math.pow(1 - progress, 3);
                        counter.textContent = Math.round(target * eased);
                        if (progress < 1) requestAnimationFrame(tick);
                    }

                    counter.textContent = '0';
                    requestAnimationFrame(tick);
                });
            }

            function goTo(index) {
                const nextIndex = Math.max(0, Math.min(index, slides.length - 1));

                if (nextIndex === current) return;

                slides[current].classList.remove('is-active');
                slides[current].classList.toggle('is-prev', nextIndex > current);

                current = nextIndex;

                slides.forEach((slide, slideIndex) => {
                    slide.classList.toggle('is-active', slideIndex === current);
                    slide.classList.toggle('is-prev', slideIndex < current && slideIndex !== current);
                    if (slideIndex === current) {
                        slide.scrollTop = 0;
                    }
                });

                progressBar.style.width = ((current + 1) / slides.length * 100) + '%';
                slideCounter.textContent = pad(current + 1) + ' / ' + pad(slides.length);
                mobileCounter.textContent = pad(current + 1) + ' / ' + pad(slides.length);
                prevButton.disabled = current === 0;
                nextButton.disabled = current === slides.length - 1;
                updateDots();

                if (slides[current].querySelector('[data-counter]')) {
                    animateCounters(slides[current]);
                }

                if (window.location.hash !== '#slide-' + (current + 1)) {
                    history.replaceState(null, '', '#slide-' + (current + 1));
                }
            }

            function startAutoPlay() {
                stopAutoPlay();
                isAutoPlaying = true;
                autoPlayButton.classList.add('is-on');
                autoPlayDot.classList.remove('bg-slate-500');
                autoPlayDot.classList.add('bg-emerald-400');
                autoPlayTimer = window.setInterval(() => {
                    if (current >= slides.length - 1) {
                        stopAutoPlay();
                        return;
                    }
                    goTo(current + 1);
                }, 9000);
            }

            function stopAutoPlay() {
                isAutoPlaying = false;
                window.clearInterval(autoPlayTimer);
                autoPlayTimer = null;
                autoPlayButton.classList.remove('is-on');
                autoPlayDot.classList.remove('bg-emerald-400');
                autoPlayDot.classList.add('bg-slate-500');
            }

            function toggleAutoPlay() {
                if (isAutoPlaying) {
                    stopAutoPlay();
                } else {
                    startAutoPlay();
                }
            }

            prevButton.addEventListener('click', () => { stopAutoPlay(); goTo(current - 1); });
            nextButton.addEventListener('click', () => { stopAutoPlay(); goTo(current + 1); });
            autoPlayButton.addEventListener('click', toggleAutoPlay);

            document.querySelectorAll('[data-next]').forEach((button) => {
                button.addEventListener('click', () => goTo(current + 1));
            });

            document.querySelectorAll('[data-restart]').forEach((button) => {
                button.addEventListener('click', () => goTo(0));
            });

            fullscreenButton.addEventListener('click', async () => {
                try {
                    if (!document.fullscreenElement) {
                        await document.documentElement.requestFullscreen();
                    } else {
                        await document.exitFullscreen();
                    }
                } catch (error) {
                    // Fullscreen can be blocked by the browser; the deck still works normally.
                }
            });

            document.addEventListener('keydown', (event) => {
                if (event.target.matches('input, textarea, select, button, a')) return;

                if (event.key === 'ArrowRight' || event.key === ' ' || event.key === 'PageDown') {
                    event.preventDefault();
                    stopAutoPlay();
                    goTo(current + 1);
                } else if (event.key === 'ArrowLeft' || event.key === 'PageUp') {
                    event.preventDefault();
                    stopAutoPlay();
                    goTo(current - 1);
                } else if (event.key === 'Home') {
                    event.preventDefault();
                    stopAutoPlay();
                    goTo(0);
                } else if (event.key === 'End') {
                    event.preventDefault();
                    stopAutoPlay();
                    goTo(slides.length - 1);
                } else if (event.key.toLowerCase() === 'f') {
                    fullscreenButton.click();
                }
            });

            document.getElementById('presentation').addEventListener('touchstart', (event) => {
                touchStartX = event.changedTouches[0].screenX;
            }, { passive: true });

            document.getElementById('presentation').addEventListener('touchend', (event) => {
                const delta = event.changedTouches[0].screenX - touchStartX;

                if (Math.abs(delta) < 55) return;

                stopAutoPlay();

                if (delta < 0) {
                    goTo(current + 1);
                } else {
                    goTo(current - 1);
                }
            }, { passive: true });

            buildDots();

            const hashMatch = window.location.hash.match(/slide-(\d+)/);
            const initialSlide = hashMatch ? Number(hashMatch[1]) - 1 : 0;

            slides[0].classList.add('is-active');
            progressBar.style.width = (1 / slides.length * 100) + '%';
            slideCounter.textContent = '01 / ' + pad(slides.length);
            mobileCounter.textContent = '01 / ' + pad(slides.length);
            updateDots();
            prevButton.disabled = true;

            if (initialSlide > 0 && initialSlide < slides.length) {
                goTo(initialSlide);
            } else {
                animateCounters(slides[0]);
            }
        })();
    </script>
</body>
</html>
