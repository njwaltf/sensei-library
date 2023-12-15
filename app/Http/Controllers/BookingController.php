<?php

namespace App\Http\Controllers;

use App\Exports\BookingsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Book;
use App\Models\Booking;
use App\Models\Favorite;
use App\Models\Forfeit;
use App\Models\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Booking | Perpus';
    public function index()
    {
        // $now = Carbon::now();
        // $date = Carbon::now()->addDays(7);
        // $result = '';
        // if ($date->gt($now)) {
        //     $result = 'telat';
        // } else {
        //     $result = 'gak telat';
        // }
        return view('dashboard.booking.index', [
            'bookings' => Booking::where('user_id', auth()->user()->id)->get(),
            'all_bookings' => Booking::latest()->get(),
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
            // 'result' => $result
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

        // $validatedData['expired_date'] = Carbon::now()->addDays(7);
        $validatedData['book_at'] = now();

        // $validatedData['user_id'] = auth()->user()->id;
        Booking::create($validatedData);
        // Book::where('id', $request->book_id)->update([
        //     'stock' => $request->stock - 1
        // ]);
        return redirect('/dashboard/bookings')->with('success', 'Peminjaman diajukan silahkan ambil buku anda ke perpustakaan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return view('dashboard.booking.show', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'booking' => $booking,
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
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
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        // edit booking
        $validatedData = $request->validate([
            'status' => ['required']
        ]);

        // notif
        $data = [
            'user_id' => $request->user_id,
            'booking_id' => $request->booking_id,
            'title' => $request->title,
            'desc' => $request->desc
        ];
        // $data['status'] = $request->status;
        if ($validatedData['status'] === 'Dipinjam') {
            // stock update
            Book::where('id', $booking->book_id)->update([
                'stock' => $booking->book->stock - 1
            ]);
            // create expired date
            $validatedData['expired_date'] = Carbon::now()->addDays(7);
            // notif
            $data['desc'] = 'Buku berhasil kamu pinjam';

        } elseif ($validatedData['status'] === 'Dikembalikan') {
            // Book stock update
            Book::where('id', $booking->book_id)->update([
                'stock' => $booking->book->stock + 1
            ]);
            // get today date
            $validatedData['return_date'] = Carbon::now();

            // check if the return_date is greater than the expired date if true denda == 1
            if ($validatedData['return_date']->gt($booking->expired_date)) {
                // create forfeit
                $forfeitData = [
                    'book_id' => $booking->book->id,
                    'user_id' => $booking->user->id,
                    'booking_id' => $booking->id,
                    'cost' => 50000,
                    'status' => 'Belum Dibayar',
                ];
                Forfeit::create($forfeitData);
                $validatedData['isDenda'] = 1;
                $data['desc'] = 'Buku dikembalikan terlambat denda wkwk';

            } else {
                $validatedData['isDenda'] = 0;
                $data['desc'] = 'Buku telah dikembalikan tepat waktu';
            }

        } elseif ($validatedData['status'] === 'Ditolak') {
            $data['desc'] = 'Gaboleh minjem lu awokawok 😂';

        }

        // denda
        if ($validatedData['status'] === 'Dikembalikan Terlambat') {
            Booking::where('id', $booking->id)->update([
                'isDenda' => 1
            ]);
        }

        // status
        $booking = Booking::where('id', $booking->id)->update($validatedData);
        // notif
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

    public function exportPDF(Request $request)
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['booking'] = [
            'id' => $request->id
        ];
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.qr-booking', $data);
        return $pdf->download('qr-code-booking.pdf');
    }

    public function generateInvoice($id)
    {
        $data['booking'] = Booking::where('id', $id)->get();
        // $booking = Booking::where('id', $id)->get();
        // $data = Booking::where('id', $id)->get();
        $pdf = Pdf::loadView('pdf.invoice', $data);
        return $pdf->download('booking_' . $id . '.pdf');
        // return view('pdf.invoice', [
        //     'booking' => $data['booking']
        // ]);
    }
    public function exportBookingPDF()
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['bookings'] = Booking::all();
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.booking', $data);
        return $pdf->download('Bookings_Data_Updated_' . Carbon::now() . '.pdf');
    }
    public function exportBookings()
    {
        return Excel::download(new BookingsExport, 'bookings_new_updated_' . Carbon::now() . '.xlsx');
    }
}
