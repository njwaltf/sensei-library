<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public $title = 'Perpus | Dashboard';
    public function index()
    {
        return view('dashboard.dashboard', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }
}