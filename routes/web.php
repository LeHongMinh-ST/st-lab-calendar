<?php

use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

//Route::get('/teams', function () {
//    return view('pages.teams');
//})->name('teams');

Route::get('/login',[AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('handleLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('handleLogout');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/edit', function () {
        return view('pages.edit');
    });
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('admin.dashboard');

    Route::prefix('calendar')->group(function () {
        Route::get('/', [CalendarController::class, 'index'])->name('admin.calendar.index');
        Route::get('/create', [CalendarController::class, 'create'])->name('admin.calendar.create');
    });
});

