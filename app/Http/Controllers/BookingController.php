<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Booking | Perpus';
    public function index()
    {
        return view('dashboard.booking.index', [
            'bookings' => Booking::where('user_id', auth()->user()->id)->get(),
            'all_bookings' => Booking::all(),
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request, Book $book)
    {
        $validatedData = $request->validate([
            'user_id' => ['required'],
            'book_id' => ['required'],
            'status' => ['required'],
            'isDenda' => ['required'],
            'stock' => ['required']
        ]);
        Booking::create($validatedData);
        Book::where('id', $request->book_id)->update([
            'stock' => $request->stock - 1
        ]);
        return redirect('/dashboard/books')->with('success', 'Peminjaman diajukan silahkan ambil buku anda ke perpustakaan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('dashboard.booking.show', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'booking' => $booking
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return view('dashboard.booking.edit', [
            'title' => $this->title,
            'booking' => $booking,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $validatedData = $request->validate([
            'status' => ['required']
        ]);
        $data = [
            'user_id' => $request->user_id,
            'booking_id' => $request->booking_id,
            'title' => $request->title,
            'desc' => $request->desc
        ];
        if ($validatedData['status'] === 'Dipinjam') {
            $data['desc'] = 'Buku berhasil kamu pinjam';
        } elseif ($validatedData['status'] === 'Dikembalikan') {
            $data['desc'] = 'Buku telah dikembalikan tepat waktu';
        } elseif ($validatedData['status'] === 'Ditolak') {
            $data['desc'] = 'Gaboleh minjem lu awokawok 😂';
        } elseif ($validatedData['status'] === 'Dikembalikan Terlambat') {
            $data['desc'] = 'Buku dikembalikan terlambat sekarang denda 😡';
        }

        if ($validatedData['status'] === 'Dikembalikan Terlambat') {
            Booking::where('id', $booking->id)->update([
                'isDenda' => 1
            ]);
        }

        $booking = Booking::where('id', $booking->id)->update($validatedData);
        Notification::create($data);
        return redirect('/dashboard/bookings/')->with('successEdit', 'Peminjaman berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking, Request $request)
    {
        Booking::destroy($booking->id);
        Book::where('id', $request->book_id)->update(['stock' => $request->stock + 2]);
        return redirect('/dashboard/bookings')->with('successDelete', 'Peminjaman berhasil dibatalkan!');
    }
}