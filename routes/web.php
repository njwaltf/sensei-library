<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'auth']);

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// resource
Route::resource('/dashboard/books', BookController::class);
Route::resource('/dashboard/bookings', BookingController::class);
Route::resource('/dashboard/users', UserController::class);
Route::get('/dashboard/bookings/{id}', [BookingController::class, 'show']);

// peminjaman
Route::post('/dashboard/bookings', [BookingController::class, 'store']);

// profile
Route::get('/dashboard/profile', [ProfileController::class, 'index'])->name('user-profile');
Route::get('/dashboard/profile/edit', [ProfileController::class, 'edit'])->name('user-profile-edit');
Route::post('/dashboard/profile/update', [ProfileController::class, 'update'])->name('user-profile-update');