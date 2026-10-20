<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalMembers = Member::count();
        $activeLoans = Loan::where('status', 'Dipinjam')->with(['book', 'member'])->latest()->get();
        $borrowedBooks = $activeLoans->count();
        $availableBooks = Book::sum('stock') - $borrowedBooks;

        $overdueCount = Loan::where('status', 'Dipinjam')
            ->whereDate('due_date', '<', Carbon::today())
            ->count();

        $totalFines = Loan::where('status', 'Dikembalikan')->sum('fine');
        $totalStaff = User::count();

        return view('dashboard.index', compact(
            'totalBooks',
            'totalMembers',
            'availableBooks',
            'borrowedBooks',
            'activeLoans',
            'overdueCount',
            'totalFines',
            'totalStaff'
        ));
    }
}