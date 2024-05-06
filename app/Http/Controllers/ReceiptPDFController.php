<?php

namespace App\Http\Controllers;

use App\Livewire\Receipt;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class ReceiptPDFController extends Controller
{
    public function receiptPDF($id)
    {
        $receipt = Shipping::with(['costs'])
            ->where('id', $id)
            ->findOrFail($id);

        $data = [
            'receipt' => $receipt,
            'price' => $receipt->costs->price,
        ];

        $pdf = Pdf::loadView('receiptPDF', $data);

        set_time_limit(300);

        return $pdf->stream('ReceiptLetter.pdf');
    }
}
