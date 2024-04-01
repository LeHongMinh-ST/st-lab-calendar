<?php

use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

Route::get('/activities', [HomeController::class, 'activities'])->name('activities');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('handleLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('handleLogout');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('/dashboard', function () {
        return view('pages.dashboard');
    })->name('admin.dashboard');

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    });

    Route::prefix('calendar')->group(function () {
        Route::get('/', [CalendarController::class, 'index'])->name('admin.calendar.index');
        Route::get('/create', [CalendarController::class, 'create'])->name('admin.calendar.create');
        Route::get('/{id}/edit', [CalendarController::class, 'edit'])->name('admin.calendar.edit');
        Route::get('/{id}', [CalendarController::class, 'show'])->name('admin.calendar.show');
    });
});
