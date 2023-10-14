<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Notification;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $title = 'Daftar Buku | Perpus';
    public function index()
    {
        return view('dashboard.book.index', [
            'title' => $this->title,
            'books' => Book::all(),
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.book.create', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'desc' => ['nullable', 'required'],
            'type' => ['required'],
            'stock' => ['required'],
            'publisher' => ['required'],
            'writer' => ['required'],
            'publish_date' => ['required'],
            'image' => ['image', 'file', 'required']
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('book-image');
        }

        Book::create($validatedData);
        return redirect('dashboard/books')->with('success', 'Data buku berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('dashboard.book.show', [
            'title' => $this->title,
            'book' => $book,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('dashboard.book.edit', [
            'title' => $this->title,
            'book' => $book,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {

        $validatedData = $request->validate([
            'title' => ['required', 'min:3', 'max:100'],
            'desc' => ['nullable', 'required'],
            'type' => ['required'],
            'stock' => ['required'],
            'publisher' => ['required'],
            'writer' => ['required'],
            'publish_date' => ['required'],
            'image' => ['image', 'file']
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('book-image');
        }
        $book = Book::where('id', $book->id)->update($validatedData);
        return redirect('/dashboard/books/')->with('successEdit', "Buku $request->title berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return redirect('/dashboard/books')->with('successDelete', 'Buku berhasil dihapus!');
    }
}