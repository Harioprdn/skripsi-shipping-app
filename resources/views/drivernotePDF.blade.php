<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-5 bg-white shadow-md rounded-lg mt-10">
        <!-- Header Section -->
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <div class="flex items-center">
                <img src="{{ public_path('assets/logodark.png') }}" alt="Company Logo" class="h-25 w-25 mr-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">CV Maju Cargo</h1>
                    <p class="text-sm text-gray-600">Jalan Babakan Ciparay No.599 Bandung</p>
                    <p class="text-sm text-gray-600">Telp: 081223867406 / 085220560553</p>
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-semibold text-gray-800">Surat Jalan</h2>
                <p class="text-sm text-gray-600"><span id="name">{{ $drivernote->drivers->name }}</span></p>
                <p class="text-sm text-gray-600"><span id="vehicle-type">{{ $drivernote->vehicles->type }}</span></p>
                <p class="text-sm text-gray-600"><span id="vehicle-number">{{ $drivernote->vehicles->number }}</span></p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 table-fixed">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-2/12 px-2 py-1 border">No</th>
                        <th class="w-2/12 px-2 py-1 border">Nomor Resi</th>
                        <th class="w-2/12 px-2 py-1 border">Dibayar Oleh</th>
                        <th class="w-2/12 px-2 py-1 border">Nama Pengirim</th>
                        <th class="w-2/12 px-2 py-1 border">Alamat Pengirim</th>
                        <th class="w-2/12 px-2 py-1 border">Nama Penerima</th>
                        <th class="w-2/12 px-2 py-1 border">Alamat Penerima</th>
                        <th class="w-1/12 px-2 py-1 border">Kota Tujuan</th>
                        <th class="w-1/12 px-2 py-1 border">Jumlah Barang</th>
                        <th class="w-2/12 px-2 py-1 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($drivernote->items as $index => $items)
                    <tr>
                        <td class="px-2 py-1 border">{{ $index + 1 }}</td>
                        <td class="px-2 py-1 border">{{ $items->number }}</td>
                        <td class="px-2 py-1 border">{{ $items->status }}</td>
                        <td class="px-2 py-1 border">{{ $items->date }}</td>
                        <td class="px-2 py-1 border">{{ $items->sender_address }}</td>
                        <td class="px-2 py-1 border">{{ $items->receiver_name }}</td>
                        <td class="px-2 py-1 border">{{ $items->receiver_address }}</td>
                        <td class="px-2 py-1 border">{{ $items->destination_city }}</td>
                        <td class="px-2 py-1 border">{{ $items->item_count }}</td>
                        <td class="px-2 py-1 border">{{ $items->note }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Footer Section -->
        <div class="flex justify-between items-center mt-10">
            <div>
                <p class="text-sm text-gray-600">Bandung, {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-gray-600">Tanda Tangan Pihak Perusahaan</p>
                <div class="h-24 border-b border-gray-400 mt-8"></div>
                <p class="text-sm text-gray-600">Nama Pihak Perusahaan</p>
            </div>
        </div>
    </div>

</body>

</html>