<?php

use App\Exports\UsersExport;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForfeitController;
use App\Http\Controllers\LandingController;
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

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'auth']);

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
// excel
Route::get('excel/export-book/', [BookController::class, 'exportBooks']);
Route::get('excel/export-booking/', [BookingController::class, 'exportBookings']);
Route::get('excel/export-user/', [UserController::class, 'exportUsers']);
// pdf
Route::get('/qr/export/{id}', [BookController::class, 'exportPDF']);
Route::get('/pdf/export-book/', [BookController::class, 'exportBookPDF']);
Route::get('/pdf/export-booking/', [BookingController::class, 'exportBookingPDF']);
Route::get('/pdf/export-user/', [UserController::class, 'exportUserPDF']);
Route::get('/export/invoice/{id}', [BookingController::class, 'generateInvoice']);
Route::get('/qr/export-booking/{id}', [BookingController::class, 'exportPDF']);
Route::get('/qr/scanner', [QRController::class, 'index'])->name('qr-scanner');
// Route::get('/qr/export/{id}', function () {
//     return view('pdf.qr');
// });

