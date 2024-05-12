<?php

namespace App\Livewire;

use App\Models\Shipping;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Livewire\Component;
use Livewire\WithPagination;

use function Laravel\Prompts\search;

class Receipt extends Component
{
    public $number;

    public $id;

    public $shipping;

    public function checkReceipt()
    {
        $this->shipping = Shipping::where('number', $this->number)->first();
    }

    public function render()
    {
        return view('livewire.receipt');
    }
}
