<?php

return [

    'dashboard' => [
        'steps' => [
            [
                'icon' => '👋',
                'title' => 'Selamat datang di Sistem Perpustakaan',
                'description' => 'Panduan singkat ini akan menunjukkan fitur penting di Dashboard. Anda bisa melewatinya kapan saja, lalu membukanya lagi lewat tombol Panduan di navbar.',
                'target' => null,
                'placement' => 'center',
            ],
            [
                'icon' => '🧭',
                'title' => 'Navigasi utama',
                'description_admin' => 'Sidebar adalah pusat navigasi Anda. Dari sini Anda bisa membuka Dashboard, Katalog Buku, Data Anggota, Peminjaman, Pengembalian, dan menu Administrasi untuk mengelola staf.',
                'description' => 'Sidebar adalah pusat navigasi Anda. Dari sini Anda bisa membuka Dashboard, Katalog Buku, Data Anggota, Peminjaman, dan Pengembalian untuk melayani anggota.',
                'target' => '#sidebar',
                'mobileTarget' => 'header #sidebar-toggle',
                'placement' => 'right',
            ],
            [
                'icon' => '📊',
                'title' => 'Ringkasan perpustakaan',
                'description' => 'Empat kartu ini menampilkan total buku, stok yang tersedia, buku yang sedang dipinjam, dan jumlah anggota secara real-time.',
                'target' => '[data-guide="dashboard-stats"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '⚡',
                'title' => 'Aksi cepat',
                'description_admin' => 'Gunakan tombol ini untuk langsung menambah buku, menambah anggota, atau membuka pengelolaan staf tanpa mencari menu lain.',
                'description' => 'Gunakan tombol ini untuk mencatat peminjaman baru, memproses pengembalian, atau membuka katalog buku.',
                'target' => '[data-guide="dashboard-actions"]',
                'placement' => 'left',
            ],
            [
                'icon' => '📋',
                'title' => 'Sirkulasi berjalan',
                'description' => 'Tabel ini menampilkan peminjaman yang masih aktif beserta tanggal jatuh temponya. Klik Lihat Semua Sirkulasi untuk membuka daftar lengkap.',
                'target' => '[data-guide="dashboard-loans"]',
                'placement' => 'top',
            ],
        ],
    ],

    'books.index' => [
        'steps' => [
            [
                'icon' => '📚',
                'title' => 'Katalog Buku',
                'description_admin' => 'Halaman ini adalah katalog seluruh koleksi. Sebagai Admin, Anda bisa menambah buku baru atau langsung membuat peminjaman dari tombol di kanan atas.',
                'description' => 'Halaman ini adalah katalog seluruh koleksi. Anda bisa mencari buku dan langsung membuat peminjaman dari tombol di kanan atas.',
                'target' => '[data-guide="books-header"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '🔎',
                'title' => 'Cari dan filter buku',
                'description' => 'Gunakan kolom pencarian untuk mencari judul, penulis, atau ISBN. Anda juga bisa memfilter berdasarkan kategori dan status ketersediaan.',
                'target' => '[data-guide="books-filters"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '🗂️',
                'title' => 'Grid koleksi',
                'description' => 'Setiap kartu menampilkan cover, status ketersediaan, penulis, dan stok. Klik kartu untuk membuka detail buku, lalu pinjamkan langsung dari halaman detail.',
                'target' => '[data-guide="books-grid"]',
                'placement' => 'top',
            ],
        ],
    ],

    'books.show' => [
        'steps' => [
            [
                'icon' => '📘',
                'title' => 'Detail dan aksi buku',
                'description_admin' => 'Di sini Anda bisa mengedit atau menghapus buku. Tombol Pinjamkan Buku membuka form peminjaman dengan buku ini sudah terpilih.',
                'description' => 'Tombol Pinjamkan Buku membuka form peminjaman dengan buku ini sudah terpilih. Status ketersediaan juga terlihat di bagian ini.',
                'target' => '[data-guide="book-header-actions"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '📦',
                'title' => 'Stok dan ketersediaan',
                'description' => 'Panel ini menunjukkan stok total, jumlah yang tersedia, ISBN, dan jumlah halaman. Gunakan informasi ini sebelum meminjamkan buku.',
                'target' => '[data-guide="book-meta"]',
                'placement' => 'right',
            ],
            [
                'icon' => '📝',
                'title' => 'Informasi buku',
                'description' => 'Bagian ini memuat penulis, penerbit, tahun terbit, kategori, dan deskripsi buku.',
                'target' => '[data-guide="book-info"]',
                'placement' => 'left',
            ],
            [
                'icon' => '⚡',
                'title' => 'Form peminjaman cepat',
                'description' => 'Jika stok tersedia, pilih anggota dan tanggal pinjam di sini, lalu klik Pinjam Buku. Sistem akan mencatat transaksi dan mengurangi stok otomatis.',
                'target' => '[data-guide="book-loan-form"]',
                'placement' => 'top',
            ],
        ],
    ],

    'books.create' => [
        'steps' => [
            [
                'icon' => '➕',
                'title' => 'Form buku baru',
                'description' => 'Isi judul, penulis, penerbit, kategori, ISBN, tahun terbit, jumlah halaman, stok, deskripsi, dan URL cover. Kolom bertanda bintang wajib diisi.',
                'target' => '[data-guide="book-form"]',
                'placement' => 'top',
            ],
            [
                'icon' => '💾',
                'title' => 'Simpan buku',
                'description' => 'Setelah data lengkap, klik Simpan Buku. Gunakan Batal untuk kembali ke katalog tanpa menyimpan perubahan.',
                'target' => '[data-guide="book-form-actions"]',
                'placement' => 'top',
            ],
        ],
    ],

    'books.edit' => [
        'steps' => [
            [
                'icon' => '✏️',
                'title' => 'Edit data buku',
                'description' => 'Perbarui informasi buku di form ini. Perubahan stok akan memengaruhi ketersediaan buku di katalog dan proses peminjaman.',
                'target' => '[data-guide="book-form"]',
                'placement' => 'top',
            ],
            [
                'icon' => '💾',
                'title' => 'Simpan perubahan',
                'description' => 'Klik Simpan Perubahan untuk menerapkan update, atau Batal untuk kembali tanpa mengubah data.',
                'target' => '[data-guide="book-form-actions"]',
                'placement' => 'top',
            ],
        ],
    ],

    'members.index' => [
        'steps' => [
            [
                'icon' => '👥',
                'title' => 'Data Anggota',
                'description_admin' => 'Halaman ini menampilkan seluruh anggota. Anda bisa melihat total anggota aktif dan menambah anggota baru dari tombol di kanan atas.',
                'description' => 'Halaman ini menampilkan seluruh anggota beserta status keaktifan dan jumlah pinjaman aktifnya.',
                'target' => '[data-guide="members-header"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '🔎',
                'title' => 'Cari dan filter anggota',
                'description' => 'Cari berdasarkan nama, ID anggota, NIM, atau email. Filter status membantu Anda menemukan anggota aktif atau nonaktif dengan cepat.',
                'target' => '[data-guide="members-filters"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '📋',
                'title' => 'Tabel anggota',
                'description_admin' => 'Tabel ini menampilkan identitas, kontak, status, dan jumlah pinjaman aktif. Gunakan kolom Aksi untuk mengedit atau menghapus anggota.',
                'description' => 'Tabel ini menampilkan identitas, kontak, status, dan jumlah pinjaman aktif setiap anggota.',
                'target' => '[data-guide="members-table"]',
                'placement' => 'top',
            ],
        ],
    ],

    'members.create' => [
        'steps' => [
            [
                'icon' => '➕',
                'title' => 'Form anggota baru',
                'description' => 'Isi ID anggota, NIM, nama lengkap, email, telepon, kelas/jurusan, dan status. ID anggota biasanya dibuat otomatis, tetapi masih bisa disesuaikan.',
                'target' => '[data-guide="member-form"]',
                'placement' => 'top',
            ],
            [
                'icon' => '💾',
                'title' => 'Simpan anggota',
                'description' => 'Klik Simpan Anggota untuk mendaftarkan anggota baru, atau Batal untuk kembali ke daftar anggota.',
                'target' => '[data-guide="member-form-actions"]',
                'placement' => 'top',
            ],
        ],
    ],

    'members.edit' => [
        'steps' => [
            [
                'icon' => '✏️',
                'title' => 'Edit data anggota',
                'description' => 'Perbarui identitas, kontak, kelas, atau status anggota. Status Nonaktif akan mencegah anggota meminjam buku baru.',
                'target' => '[data-guide="member-form"]',
                'placement' => 'top',
            ],
            [
                'icon' => '💾',
                'title' => 'Simpan perubahan',
                'description' => 'Klik Simpan Perubahan untuk menerapkan update, atau Batal untuk kembali tanpa mengubah data.',
                'target' => '[data-guide="member-form-actions"]',
                'placement' => 'top',
            ],
        ],
    ],

    'loans.index' => [
        'steps' => [
            [
                'icon' => '📖',
                'title' => 'Peminjaman aktif',
                'description' => 'Halaman ini memantau semua buku yang sedang dipinjam. Klik Buat Peminjaman untuk mencatat transaksi baru.',
                'target' => '[data-guide="loans-header"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '🔎',
                'title' => 'Cari peminjaman',
                'description' => 'Cari transaksi berdasarkan judul buku atau nama anggota yang sedang meminjam.',
                'target' => '[data-guide="loans-filters"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '📋',
                'title' => 'Tabel peminjaman',
                'description' => 'Tabel menampilkan kode pinjam, buku, anggota, tanggal pinjam, jatuh tempo, dan status keterlambatan. Klik Kembalikan untuk memproses pengembalian.',
                'target' => '[data-guide="loans-table"]',
                'placement' => 'top',
            ],
        ],
    ],

    'loans.create' => [
        'steps' => [
            [
                'icon' => '📚',
                'title' => 'Pilih buku',
                'description' => 'Pilih buku yang akan dipinjam. Daftar ini hanya menampilkan buku dengan stok tersedia beserta sisa stoknya.',
                'target' => '#book_id',
                'placement' => 'bottom',
            ],
            [
                'icon' => '👤',
                'title' => 'Pilih anggota',
                'description' => 'Pilih anggota yang meminjam. Pastikan status anggota aktif agar transaksi dapat diproses.',
                'target' => '#member_id',
                'placement' => 'bottom',
            ],
            [
                'icon' => '📅',
                'title' => 'Atur tanggal',
                'description' => 'Tanggal pinjam terisi otomatis hari ini. Jatuh tempo default 7 hari ke depan dan masih bisa disesuaikan.',
                'target' => '[data-guide="loan-dates"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '💾',
                'title' => 'Simpan peminjaman',
                'description' => 'Klik Simpan Peminjaman untuk mencatat transaksi. Stok buku akan berkurang otomatis.',
                'target' => '[data-guide="loan-form-actions"]',
                'placement' => 'top',
            ],
        ],
    ],

    'returns.index' => [
        'steps' => [
            [
                'icon' => '🔄',
                'title' => 'Pengembalian buku',
                'description' => 'Di sini Anda memproses buku yang dikembalikan. Sistem menghitung keterlambatan dan denda secara otomatis.',
                'target' => '[data-guide="returns-header"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '🔎',
                'title' => 'Cari transaksi',
                'description' => 'Cari berdasarkan judul buku atau nama anggota untuk menemukan transaksi yang akan dikembalikan.',
                'target' => '[data-guide="returns-filters"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '📋',
                'title' => 'Daftar sedang dipinjam',
                'description' => 'Tabel ini menampilkan buku yang masih dipinjam, jatuh tempo, status keterlambatan, dan tombol Kembalikan.',
                'target' => '[data-guide="returns-active"]',
                'placement' => 'top',
            ],
            [
                'icon' => '🕘',
                'title' => 'Riwayat pengembalian',
                'description' => 'Bagian bawah menampilkan riwayat buku yang sudah dikembalikan, termasuk denda dan keterlambatan.',
                'target' => '[data-guide="returns-history"]',
                'placement' => 'top',
            ],
        ],
    ],

    'users.index' => [
        'steps' => [
            [
                'icon' => '🛡️',
                'title' => 'Manajemen staf',
                'description' => 'Halaman khusus Administrator untuk mengelola akun yang bisa mengakses sistem. Klik Tambah Akun Staf Baru untuk membuat akun.',
                'target' => '[data-guide="users-header"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '📊',
                'title' => 'Ringkasan staf',
                'description' => 'Kartu ini menampilkan total staf, jumlah Administrator, dan jumlah Petugas Sirkulasi.',
                'target' => '[data-guide="users-stats"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => 'ℹ️',
                'title' => 'Hak akses',
                'description' => 'Bandingkan hak akses Administrator dan Petugas Sirkulasi sebelum membuat atau mengubah akun.',
                'target' => '[data-guide="users-roles"]',
                'placement' => 'bottom',
            ],
            [
                'icon' => '📋',
                'title' => 'Daftar akun staf',
                'description' => 'Gunakan pencarian dan filter peran untuk menemukan akun. Kolom Aksi bisa dipakai untuk menghapus akun staf.',
                'target' => '[data-guide="users-table"]',
                'placement' => 'top',
            ],
        ],
    ],

    'default' => [
        'steps' => [
            [
                'icon' => '🧭',
                'title' => 'Navigasi utama',
                'description' => 'Gunakan sidebar untuk berpindah antar halaman perpustakaan.',
                'target' => '#sidebar',
                'mobileTarget' => 'header #sidebar-toggle',
                'placement' => 'right',
            ],
            [
                'icon' => '📄',
                'title' => 'Konten halaman',
                'description' => 'Area ini menampilkan informasi dan fitur sesuai halaman yang sedang Anda buka.',
                'target' => 'main',
                'placement' => 'top',
            ],
        ],
    ],

];
