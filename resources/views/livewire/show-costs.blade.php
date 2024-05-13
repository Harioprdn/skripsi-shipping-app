@section('title','Biaya Pengiriman')

<div>
    @livewire('header2', ['title' => 'Biaya Pengiriman'])

    <div class="border rounded-2xl py-12 flex justify-center items-center">
        <div class="container max-w-xl">

            {{ $this->table }}

        </div>
    </div>
</div>