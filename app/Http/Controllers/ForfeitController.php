<?php

namespace App\Http\Controllers;

use App\Exports\ForfeitExport;
use Carbon\Carbon;
use App\Models\Forfeit;
use App\Models\Favorite;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\StoreForfeitRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\UpdateForfeitRequest;

class ForfeitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Denda | Perpus';

    public function index()
    {
        return view('dashboard.forfeit.index-new', [
            'forfeits' => Forfeit::where('user_id', auth()->user()->id)->get(),
            'all_forfeits' => Forfeit::all(),
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
    public function store(StoreForfeitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Forfeit $forfeit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forfeit $forfeit)
    {
        return view('dashboard.forfeit.edit-new', [
            'title' => $this->title,
            'forfeit' => $forfeit,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateForfeitRequest $request, Forfeit $forfeit)
    {
        $validatedData = $request->validate([
            'status' => ['required']
        ]);

        $data = [
            'user_id' => $forfeit->user_id,
            'booking_id' => $forfeit->booking_id,
            'title' => 'Pembaruan Status Denda',
            'desc' => 'deskripsi'
        ];
        $validatedData['pay_date'] = Carbon::now();
        if ($validatedData['status'] === 'Tolak') {
            $data['desc'] = 'Bukti Pembayaran kamu ditolak';
        } elseif ($validatedData['status'] === 'Dibayar') {
            $data['desc'] = 'Pembayaran Berhasil Denda Selesai!';
        }
        $forfeit = Forfeit::where('id', $forfeit->id)->update($validatedData);
        Notification::create($data);
        return redirect('/dashboard/forfeits/')->with('successEdit', 'Denda berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function uploadImage(Request $request)
    {
        $data = $request->validate([
            'pay_image' => ['required', 'image', 'file'],
            'status' => ['required'],
        ]);

        if ($request->file('pay_image')) {
            $data['pay_image'] = $request->file('pay_image')->store('pay-images');
        }
        $book = Forfeit::where('id', $request->id)->update($data);
        return redirect('/dashboard/forfeits/')->with('successUpload', "Bukti pembayaran berhasil diupload!");
    }
    public function exportForfeits()
    {
        return Excel::download(new ForfeitExport, 'forfeits_new_updated_' . Carbon::now() . '.xlsx');
    }
    public function exportForfeitPDF()
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['forfeits'] = Forfeit::all();
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.forfeit', $data);
        return $pdf->download('forfeits_Data_Updated_' . Carbon::now() . '.pdf');
    }
}
