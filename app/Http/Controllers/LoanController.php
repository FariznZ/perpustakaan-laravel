<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class LoanController extends Controller
{
    public function index(Request $request)
    {
        $query = Loan::with(['book', 'member'])->where('status', 'Dipinjam');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('book', fn($q) => $q->where('title', 'like', "%{$search}%"))
                  ->orWhereHas('member', fn($q) => $q->where('name', 'like', "%{$search}%"));
        }

        $loans = $query->latest()->paginate(15)->withQueryString();

        return view('loans.index', compact('loans'));
    }

    public function create()
    {
        $books = Book::whereHas('loans', function ($q) {
            $q->where('status', 'Dipinjam');
        }, '<', DB::raw('books.stock'))->orWhereDoesntHave('loans')
            ->orderBy('title')->get(['id', 'title', 'author', 'stock']);

        $members = Member::where('status', 'Aktif')->orderBy('name')->get(['id', 'name', 'member_id']);

        return view('loans.create', compact('books', 'members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'member_id' => ['required', 'exists:members,id'],
            'loan_date' => ['required', 'date', 'before_or_equal:today'],
            'due_date' => ['required', 'date', 'after:loan_date'],
        ]);

        $book = Book::findOrFail($validated['book_id']);
        
        if ($book->available <= 0) {
            return back()->withErrors(['book_id' => 'Buku tidak tersedia untuk dipinjam'])->withInput();
        }

        $lastLoan = Loan::latest('id')->first();
        $nextNumber = ($lastLoan ? (int)Str::afterLast($lastLoan->loan_code, '-') : 0) + 1;
        $loanCode = 'PJ-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        DB::transaction(function () use ($validated, $loanCode) {
            Loan::create([
                'loan_code' => $loanCode,
                'book_id' => $validated['book_id'],
                'member_id' => $validated['member_id'],
                'loan_date' => $validated['loan_date'],
                'due_date' => $validated['due_date'],
                'status' => 'Dipinjam',
            ]);
        });

        return redirect()->route('loans.index')->with('success', 'Peminjaman berhasil dibuat');
    }

    public function return(Loan $loan)
    {
        if ($loan->status === 'Dikembalikan') {
            return back()->withErrors(['loan' => 'Buku sudah dikembalikan']);
        }

        DB::transaction(function () use ($loan) {
            $daysLate = max(0, Carbon::today()->diffInDays($loan->due_date, false));
            $fine = $daysLate > 0 ? $daysLate * 1000 : 0;

            $loan->update([
                'status' => 'Dikembalikan',
                'return_date' => Carbon::today(),
                'days_late' => $daysLate,
                'fine' => $fine,
            ]);
        });

        return redirect()->route('returns.index')->with('success', 'Buku berhasil dikembalikan');
    }
}