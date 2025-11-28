<?php


namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();

        $totalBooks = $books->count();

        $currentlyLent = $books->filter(function ($book) {
            return !empty($book->renter_name) || !empty($book->rent_date);
        })->count();

        return view('books.index', compact('books', 'totalBooks', 'currentlyLent'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer',
            'isbn' => 'required|string|max:255|unique:books,isbn',
            'genre' => 'required|string|max:255',
            'renter_name' => 'nullable|string|max:255',
            'rent_date' => 'nullable|date',
            'return_date' => 'nullable|date',
        ]);

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Книгата е успешно додадена.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer',
            'isbn' => 'required|string|max:255|unique:books,isbn,' . $book->id,
            'genre' => 'required|string|max:255',
            'renter_name' => 'nullable|string|max:255',
            'rent_date' => 'nullable|date',
            'return_date' => 'nullable|date',
        ]);

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Книгата е успешно ажурирана.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Книгата е избришана.');
    }

}
