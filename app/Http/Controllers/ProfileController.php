<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $title = 'Profile | Perpus';
    public function index()
    {
        return view('dashboard.profile.index', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'max:100'],
            'email' => 'required|email|unique:users,email,' . $request->id,
            'username' => 'required|min:4|unique:users,username,' . $request->id,
            'prof_pic' => ['file', 'image']
        ]);
        // if ($request->email != $data['email']) {
        //     $data['email']->validate(['email' => ['required', 'email', 'max:100', 'unique:users']]);
        // }
        if ($request->file('prof_pic')) {
            $data['prof_pic'] = $request->file('prof_pic')->store('profile');
        }

        $user = User::where('id', $request->id)->update($data);

        return redirect()->route('user-profile')->with('successEdit', 'Profile kamu berhasil diperbarui!');

    }
    public function edit()
    {
        return view('dashboard.profile.edit', [
            'title' => $this->title,
            'notifications' => Notification::where('user_id', auth()->user()->id)->get()
        ]);
    }

}
