@section('title','Cek Resi Pengiriman')

<div>
    @livewire('header2', ['title' => 'Cek Resi Pengiriman'])

    <div class="max-w-xl mx-auto p-4">
        <form wire:submit.prevent="checkReceipt" class="shadow-md rounded-xl px-8 py-6 bg-white mt-10">
            <div class="mb-6">
                <input type="text" wire:model="number" id="number" name="number" class="shadow appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('number') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                    Cek Resi
                </button>
            </div>
        </form>

        <!-- Detail Pengiriman atau Notifikasi -->
        @if($shipping)
        <div class="shadow-md rounded-xl mt-6 bg-white">
            <h2 class="text-center font-bold px-4 py-2 border-b border-gray-200">Detail Pengiriman</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Nomor Resi</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->number }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Status</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->status }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Nama Pengirim</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->sender_name }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Alamat Pengirim</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->sender_address }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Nama Penerima</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->receiver_name }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Alamat Penerima</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->receiver_address }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Jenis Barang</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->items->name }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Tanggal Order</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->date }}</td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap font-semibold">Biaya Pengiriman</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $shipping->price }}</td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
        @elseif($number && !$shipping)
        <div class="shadow-md rounded-xl mt-6 p-4 bg-white">
            <p class="text-red-500">Resi "{{ $number }}" tidak ditemukan.</p>
        </div>
        @endif
    </div>

</div>