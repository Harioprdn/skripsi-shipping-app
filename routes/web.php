<?php

use App\Http\Controllers\ReceiptPDFController;
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

Route::get('/', \App\Livewire\Home::class)->name('home');

Route::get('/contact-us', \App\Livewire\ContactUs::class)->name('contact-us');

Route::get('/receiptpdf/{id}', [\App\Http\Controllers\ReceiptPDFController::class, 'receiptpdf'])->name('receipt.pdf');

Route::get('/receipt', \App\Livewire\Receipt::class)->name('receipt');

Route::get('/cost', \App\Livewire\Cost::class)->name('cost');
