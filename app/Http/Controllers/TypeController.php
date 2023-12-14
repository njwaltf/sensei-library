<?php

namespace App\Http\Controllers;

use App\Exports\TypesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Book;
use App\Models\Notification;
use App\Models\Type;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Genre | Perpus';
    public function index()
    {
        return view('dashboard.type.index', [
            'title' => $this->title,
            'types' => Type::latest()->get(),
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.type.create', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'desc' => ['required'],
        ]);

        Type::create($validatedData);
        return redirect('dashboard/types')->with('success', 'Data genre berhasil tersimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('dashboard.type.show', [
            'title' => $this->title,
            'type' => $type,
            // 'date_now' => $date_now,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('dashboard.type.edit', [
            'title' => $this->title,
            'type' => $type,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'desc' => ['required'],
        ]);

        Type::where('id', $type->id)->update($validatedData);
        return redirect('dashboard/types')->with('successEdit', 'Data genre berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        Type::destroy($type->id);
        return redirect('/dashboard/types')->with('successDelete', 'Genre Buku berhasil dihapus!');
    }
    public function exportTypePDF()
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['types'] = Type::all();
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.type', $data);
        return $pdf->download('Book_Type_Data_Updated_' . Carbon::now() . '.pdf');
    }
    public function exportTypes()
    {
        return Excel::download(new TypesExport, 'book_types_new_updated_' . Carbon::now() . '.xlsx');
    }
}
