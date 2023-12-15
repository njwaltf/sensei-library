<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Notification;
use Illuminate\Routing\Controller;

class QRController extends Controller
{
    public $title = 'QR Scanner | Perpus';
    public function index()
    {
        return view("qr.index", [
            "title" => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'favorites' => Favorite::where('user_id', auth()->user()->id)->get()
        ]);
    }
}
