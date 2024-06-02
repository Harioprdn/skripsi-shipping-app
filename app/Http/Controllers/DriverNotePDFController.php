<?php

namespace App\Http\Controllers;

use App\Models\ShippingNote;
use App\Filament\Resources\ShippingNoteResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DriverNotePDFController extends Controller
{

    public function drivernotePDF($id)
    {
        $drivernote = ShippingNote::with(['shippings', 'items', 'items.shippings', 'shippings.items'])
            ->findOrFail($id);

        $data = [
            'drivernote' => $drivernote,
        ];

        $pdf = Pdf::loadView('drivernotePDF', $data)->setPaper('a4', 'landscape')->setWarnings(false);

        set_time_limit(300);

        return $pdf->stream('DriverNote.pdf');
    }
}
