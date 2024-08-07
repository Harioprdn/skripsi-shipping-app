<?php

use App\Http\Controllers\ReceiptPDFController;
use App\Livewire\Receipt;
use App\Livewire\ResultReceipt;
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

Route::get('/feedback', \App\Livewire\Feedback::class)->name('feedback');

Route::get('/receiptpdf/{id}', [\App\Http\Controllers\ReceiptPDFController::class, 'receiptpdf'])->name('receipt.pdf');

Route::get('/drivernotepdf/{id}', [\App\Http\Controllers\DriverNotePDFController::class, 'drivernotepdf'])->name('drivernote.pdf');

Route::get('/receipt', \App\Livewire\Receipt::class)->name('receipt');

Route::get('/show-costs', \App\Livewire\ShowCosts::class)->name('show-costs');
