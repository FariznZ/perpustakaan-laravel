<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhere('isbn', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            if ($request->status === 'Tersedia') {
                $query->whereHas('loans', function ($q) {
                    $q->where('status', 'Dipinjam');
                }, '<', 1)->orWhereDoesntHave('loans');
            } elseif ($request->status === 'Dipinjam') {
                $query->whereHas('loans', function ($q) {
                    $q->where('status', 'Dipinjam');
                }, '>=', 1);
            }
        }

        $books = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        $book->load(['category', 'loans.member']);
        $activeLoan = $book->loans()->where('status', 'Dipinjam')->first();

        return view('books.show', compact('book', 'activeLoan'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'isbn' => ['nullable', 'string', 'unique:books,isbn'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'stock' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'cover_url' => ['nullable', 'url'],
        ]);

        $book = Book::create($validated);

        return redirect()->route('books.show', $book)
            ->with('success', 'Buku "' . $book->title . '" berhasil ditambahkan ke katalog.');
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:' . (date('Y') + 1)],
            'isbn' => ['nullable', 'string', Rule::unique('books', 'isbn')->ignore($book->id)],
            'category_id' => ['nullable', 'exists:categories,id'],
            'pages' => ['nullable', 'integer', 'min:1'],
            'stock' => ['required', 'integer', 'min:1'],
            'description' => ['nullable', 'string'],
            'cover_url' => ['nullable', 'url'],
        ]);

        $book->update($validated);

        return redirect()->route('books.show', $book)
            ->with('success', 'Data buku "' . $book->title . '" berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        if ($book->loans()->where('status', 'Dipinjam')->exists()) {
            return back()->with('error', 'Buku tidak dapat dihapus karena masih ada eksemplar yang sedang dipinjam.');
        }

        $title = $book->title;
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku "' . $title . '" berhasil dihapus dari sistem.');
    }
}