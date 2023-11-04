<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booking;
use App\Models\Forfeit;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public $title = 'Perpus | Dashboard';
    public function index()
    {
        // booking
        $count_user_bookings = Booking::where('user_id', auth()->user()->id)->count();
        $count_all_bookings = Booking::count();
        $active_user_bookings = Booking::where([
            'user_id'=> auth()->user()->id,
            'status'=> 'Dipinjam',
        ])->count();
        $done_user_bookings = Booking::where([
            'user_id'=> auth()->user()->id,
            'status'=> 'Dikembalikan',
        ])->count();
        $active_all_bookings = Booking::where('status','Dipinjam')->count();
        $done_all_bookings = Booking::where('status','Dikembalikan')->count();

        // denda
        $count_user_forfeits = Forfeit::where('user_id', auth()->user()->id)->count();
        $count_all_forfeits = Forfeit::count();
        $active_user_forfeits = Forfeit::where([
            'user_id'=> auth()->user()->id,
            'status'=> 'Belum Dibayar',
        ])->count();
        $active_all_forfeits = Forfeit::where('status','Belum Dibayar')->count();
        $done_user_forfeits = Forfeit::where([
            'user_id'=> auth()->user()->id,
            'status'=> 'Dibayar',
        ])->count();
        $done_all_forfeits = Forfeit::where('status','Dibayar')->count();

        // user
        $count_user = User::count();
        $member_user = User::where('role','member')->count();
        $admin_user = User::where('role','admin')->count();

        // book
        $count_book = Book::count();
        $avail_book = Book::where('stock','>',0)->count();
        $empty_book = Book::where('stock','=',0)->count();

        return view('index', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'count_user_bookings' => $count_user_bookings,
            'count_all_bookings' => $count_all_bookings,
            'active_user_bookings' => $active_user_bookings,
            'active_all_bookings'=> $active_all_bookings,
            'done_user_bookings'=> $done_user_bookings,
            'done_all_bookings'=> $done_all_bookings,
            'count_user_forfeits'=> $count_user_forfeits,
            'count_all_forfeits'=> $count_all_forfeits,
            'done_user_forfeits' => $done_user_forfeits,
            'done_all_forfeits' => $done_all_forfeits,
            'active_user_forfeits'=> $active_user_forfeits,
            'active_all_forfeits'=> $active_all_forfeits,
            'member_user'=> $member_user,
            'admin_user'=> $admin_user,
            'count_user'=> $count_user,
            'avail_book'=> $avail_book,
            'empty_book'=> $empty_book,
            'count_book'=> $count_book,
            'latest_bookings'=> Booking::latest()->take(5)->get(),
        ]);
    }
}
