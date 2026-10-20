<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Guest Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

// Authenticated Routes (Accessible by Admin and Petugas)
Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('guide/seen', function () {
        $data = request()->validate([
            'page_key' => ['required', 'string', 'max:100'],
        ]);

        $now = now();

        \Illuminate\Support\Facades\DB::table('user_guide_progress')->upsert(
            [[
                'user_id' => request()->user()->id,
                'page_key' => $data['page_key'],
                'seen_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ]],
            ['user_id', 'page_key'],
            ['seen_at', 'updated_at']
        );

        return response()->noContent();
    })->name('guide.seen');

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Operational Sirkulasi (Peminjaman & Pengembalian)
    Route::resource('loans', LoanController::class)->only(['index', 'create', 'store']);
    Route::post('loans/{loan}/return', [LoanController::class, 'return'])->name('loans.return');
    Route::get('returns', [ReturnController::class, 'index'])->name('returns.index');

    // Admin-Only Routes: Book Creation, Edit, Delete
    Route::middleware('admin')->group(function () {
        Route::get('books/create', [BookController::class, 'create'])->name('books.create');
        Route::post('books', [BookController::class, 'store'])->name('books.store');
        Route::get('books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
        Route::put('books/{book}', [BookController::class, 'update'])->name('books.update');
        Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

        Route::get('members/create', [MemberController::class, 'create'])->name('members.create');
        Route::post('members', [MemberController::class, 'store'])->name('members.store');
        Route::get('members/{member}/edit', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('members/{member}', [MemberController::class, 'update'])->name('members.update');
        Route::delete('members/{member}', [MemberController::class, 'destroy'])->name('members.destroy');

        // Staff / Users Management
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Catalog & Members (Read-only for Petugas, with CRUD actions visible to Admin)
    Route::resource('books', BookController::class)->only(['index', 'show']);
    Route::resource('members', MemberController::class)->only(['index']);
});

// Public interactive project presentation
Route::get('/presentasi', fn () => view('presentation.index'))->name('presentation');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});