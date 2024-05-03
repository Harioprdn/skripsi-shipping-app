@section('title','Hubungi Kami')

<div>
    @livewire('header2', ['title' => 'Hubungi Kami'])

    <div class="border rounded-2xl py-12 flex justify-center items-center">
        <div class="container max-w-xl">
            <form wire:submit.prevent="submit">
                {{ $this->form }}

                <button type="submit" class="py-2 px-3 text-sm font-semibold bg-primary-600 text-white rounded-lg mt-4">
                    Kirim
                </button>
            </form>
        </div>
    </div>
</div>