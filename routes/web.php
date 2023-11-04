<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForfeitController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TypeController;
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

Route::get('/register', [RegisterController::class, 'index'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'auth']);

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    // book
    Route::resource('/books', BookController::class);
    Route::get('/books', [BookController::class, 'index']);

    // forfeit
    Route::resource('/forfeits', ForfeitController::class);

    // type
    Route::resource('/types', TypeController::class);

    // booking
    Route::resource('/bookings', BookingController::class);
    Route::get('/bookings/{id}', [BookingController::class, 'show']);
    Route::post('/bookings', [BookingController::class, 'store']);

    // user
    Route::resource('/users', UserController::class);

    // profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('user-profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('user-profile-edit');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('user-profile-update');
    Route::post('/forfeits/update', [ForfeitController::class, 'uploadImage'])->name('upload-payment');
});
// qr
Route::get('/qr/export/{id}', [BookController::class, 'exportPDF']);
Route::get('/qr/scanner', [QRController::class, 'index'])->name('qr-scanner');
// Route::get('/qr/export/{id}', function () {
//     return view('pdf.qr');
// });

