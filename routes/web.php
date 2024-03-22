<?php

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

Route::get('/teams', function () {
    return view('pages.teams');
})->name('teams');

Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('handleLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('handleLogout');

Route::prefix('admin')->group(function () {
    Route::middleware(['auth'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });
        Route::get('/dashboard', function () {
            return view('pages.dashboard');
        })->name('admin.dashboard');
    });
});
