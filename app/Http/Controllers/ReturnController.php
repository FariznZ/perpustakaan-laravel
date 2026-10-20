<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function index(Request $request)
    {
        $activeQuery = Loan::with(['book', 'member'])->where('status', 'Dipinjam');
        $historyQuery = Loan::with(['book', 'member'])->where('status', 'Dikembalikan');

        if ($request->filled('search')) {
            $search = $request->search;
            $activeQuery->whereHas('book', fn($q) => $q->where('title', 'like', "%{$search}%"))
                        ->orWhereHas('member', fn($q) => $q->where('name', 'like', "%{$search}%"));
            $historyQuery->whereHas('book', fn($q) => $q->where('title', 'like', "%{$search}%"))
                         ->orWhereHas('member', fn($q) => $q->where('name', 'like', "%{$search}%"));
        }

        $activeLoans = $activeQuery->latest()->paginate(10)->withQueryString();
        $historyLoans = $historyQuery->latest()->paginate(10)->withQueryString();

        return view('returns.index', compact('activeLoans', 'historyLoans'));
    }
}