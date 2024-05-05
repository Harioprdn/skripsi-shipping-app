<?php

namespace App\Http\Controllers;

use App\Livewire\Receipt;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\App;

class ReceiptPDFController extends Controller
{
    public function receiptPDF($id)
    {
        $receipt = Shipping::with(['contracts', 'contracts.surveyors', 'contracts.industries', 'contracts.contract_types', 'contracts.assets'])
            ->where('id', $id)
            ->findOrFail($id);

        $data = [
            'date' => $receipt->tanggal_penugasan,
            'assignment' => $receipt,
            'location' => $receipt->contracts->lokasi_proyek,
            'asset' => $receipt->contracts->assets->type,
        ];

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</>');

        return $pdf->download('ReceiptLetter.pdf');
    }
}
