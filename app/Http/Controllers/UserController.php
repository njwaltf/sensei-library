<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
// use App\Models\Book;
use App\Models\User;
use App\Exports\UsersExport;
use App\Models\Notification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $title = 'Kelola User | Perpus';
    public function index()
    {
        return view('dashboard.user.index', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.user.create', [
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'title' => $this->title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required', 'email', 'max:100', 'unique:users'],
            'username' => ['required', 'unique:users', 'max:20', 'min:4'],
            'name' => ['required', 'unique:users', 'max:100'],
            'password' => ['required', 'min:8'],
            'prof_pic' => ['required']
        ]);
        // password hash
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        // succes
        return redirect('/dashboard/users')->with('success', 'Akun berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.user.show', [
            'title' => $this->title,
            'user' => $user,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.user.edit', [
            'user' => $user,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get(),
            'title' => $this->title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'role' => ['required']
        ]);
        $user = User::where('id', $user->id)->update($validatedData);
        return redirect('/dashboard/users/')->with('successEdit', "Role user berhasil diperbarui!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect('/dashboard/users')->with('successDelete', 'Akun berhasil dihapus!');
    }
    public function exportUserPDF()
    {
        // $book = Book::where('id', $request->id)->get('id');
        $data['users'] = User::all();
        // $pdf = Pdf::loadView('pdf.qr', $book);
        // return $pdf->stream();
        $pdf = Pdf::loadView('pdf.user', $data);
        return $pdf->download('User_Data_Updated_' . Carbon::now() . '.pdf');
    }
    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users_new_updated_' . Carbon::now() . '.xlsx');
    }
}
