<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;

class QRController extends Controller
{
    public $title = 'QR Scanner | Perpus';
    public function index()
    {
        return view("qr.index", [
            "title" => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }
}
