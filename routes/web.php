<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeetingController;

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
    return view('welcome');
});

Auth::routes();

Route::post('/meetings', [MeetingController::class, 'store'])->name('meetings.store');
Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');

// Update meeting form
Route::get('/meetings/{meeting}/edit', [MeetingController::class, 'edit'])->name('meetings.edit');

// Update meeting action
Route::put('/meetings/{meeting}', [MeetingController::class, 'update'])->name('meetings.update');

// Delete meeting action
Route::delete('/meetings/{meeting}', [MeetingController::class, 'destroy'])->name('meetings.destroy');


Route::get('/home', [HomeController::class, 'index'])->name('home');
