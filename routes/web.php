<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/login', function () {
//     return redirect(route('filament.admin.auth.login'));
// })->name('login');

Route::get('/', \App\Livewire\Home::class)->name('home');

Route::get('/contact-us', \App\Livewire\ContactUs::class)->name('contact-us');


// Route::get('/service', \App\Http\Livewire\ListServices::class)->name('services');

// Route::get('/service/{service}', \App\Http\Livewire\ShowService::class)->name('service');

// Route::get('/borrow-book', \App\Http\Livewire\Borrow::class)->name('borrow-book');

// Route::get('/borrow-room', \App\Http\Livewire\BorrowRoom::class)->name('borrow-room');
