<?php

namespace App\Http\Controllers;

use App\Exports\BooksExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\Favorite;
use App\Models\Notification;
use App\Models\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $title = 'Daftar Buku | Perpus';
    public function index(Request $request)
    {
        if ($request->filled('search_keyword')) {
            $keyword = $request->input('search_keyword');
            $books = Book::search($keyword)->get();
        } else {
            $books = Book::get();
        }
        // $books = Book::where('column', 'value...')->get();
        return view('dashboard.book.index', [
            'title' => $this->title,
            'books' => $books,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.book.create', [
            'title' => $this->title,
            'types' => Type::all(),
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
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
            'type_id' => ['required'],
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
        // $date_now = Carbon::now()->addDays(3);
        return view('dashboard.book.show', [
            'title' => $this->title,
            'book' => $book,
            // 'date_now' => $date_now,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
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
            'types' => Type::all(),
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
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
            'type_id' => ['required'],
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

    public function exportPDF(Request $request)
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['book'] = [
            'id' => $request->id
        ];
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.qr', $data);
        return $pdf->download('qr-code.pdf');
    }
    public function exportBookPDF()
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['books'] = Book::all();
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.book', $data);
        return $pdf->download('Book_Data_Updated_' . Carbon::now() . '.pdf');
    }
    public function exportBooks()
    {
        return Excel::download(new BooksExport, 'books_new_updated_' . Carbon::now() . '.xlsx');
    }
}
