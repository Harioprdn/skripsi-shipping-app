<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Jalan - {{ $drivernote->drivers->name }} ({{ $drivernote->shipping_date }})</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            body {
                width: 21cm;
                height: 29.7cm;
                margin: 0;
            }

            .max-w-4xl {
                max-width: none;
            }

            .overflow-x-auto {
                overflow-x: visible;
            }
        }

        table {
            table-layout: auto;
            /* Mengizinkan kolom menyesuaikan lebar berdasarkan konten */
        }

        table th {
            word-wrap: break-word;
            overflow-wrap: break-word;
            font-size: 10px;
            /* Ukuran font untuk header tetap 10px */
            white-space: normal;
            padding: 2px 4px;
        }

        table td {
            word-wrap: break-word;
            overflow-wrap: break-word;
            font-size: 6px;
            /* Ukuran font untuk sel data lebih kecil */
            white-space: normal;
            padding: 2px 4px;
        }

        th.w-1/24 {
            width: 4%;
            /* Mengatur lebar kolom "No" lebih kecil */
        }

        .max-w-4xl {
            max-width: 95%;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="max-w-4xl mx-auto p-5 bg-white shadow-md rounded-lg mt-10">
        <!-- Header Section -->
        <div class="flex justify-between items-center border-b pb-4 mb-4">
            <div class="flex items-center">
                <img src="{{ public_path('assets/logodark.png') }}" alt="Company Logo" class="h-25 w-25 mr-4">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">CV Maju Cargo</h1>
                    <p class="text-xs text-gray-600">Jalan Babakan Ciparay No.599 Bandung</p>
                    <p class="text-xs text-gray-600">Telp: 081223867406 / 085220560553</p>
                </div>
            </div>
            <div class="text-right">
                <h2 class="text-lg font-semibold text-gray-800">Surat Jalan</h2>
                <p class="text-xs text-gray-600"><span id="name">{{ $drivernote->drivers->name }}</span></p>
                <p class="text-xs text-gray-600"><span id="vehicle-type">{{ $drivernote->vehicles->type }}</span></p>
                <p class="text-xs text-gray-600"><span id="vehicle-number">{{ $drivernote->vehicles->number }}</span></p>
            </div>
        </div>

        <!-- Content Section -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="w-1/24 px-1 py-1 border">No</th>
                        <th class="px-2 py-1 border">Nomor Resi</th>
                        <th class="px-2 py-1 border">Dibayar Oleh</th>
                        <th class="px-2 py-1 border">Nama Pengirim</th>
                        <th class="px-2 py-1 border">Alamat Pengirim</th>
                        <th class="px-2 py-1 border">Nama Penerima</th>
                        <th class="px-2 py-1 border">Alamat Penerima</th>
                        <th class="px-2 py-1 border">Kota Tujuan</th>
                        <th class="px-2 py-1 border">Biaya</th>
                        <th class="px-2 py-1 border">Jumlah Barang</th>
                        <th class="px-2 py-1 border">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @if($drivernote->shippingnoteitems)
                    @foreach ($drivernote->shippingnoteitems as $index => $shippingnoteitems)
                    <tr>
                        <td class="w-1/24 px-1 py-1 border text-xs text-center">{{ $index + 1 }}</td>
                        <td class="px-2 py-1 border text-xs text-center">{{ $shippingnoteitems->shippings->number }}</td>
                        <td class="px-2 py-1 border text-xs">{{ $shippingnoteitems->shippings->payment }}</td>
                        <td class="px-2 py-1 border text-xs">{{ $shippingnoteitems->shippings->sender_name }}</td>
                        <td class="px-2 py-1 border text-xs">{{ $shippingnoteitems->shippings->sender_address }}</td>
                        <td class="px-2 py-1 border text-xs">{{ $shippingnoteitems->shippings->receiver_name }}</td>
                        <td class="px-2 py-1 border text-xs">{{ $shippingnoteitems->shippings->receiver_address }}</td>
                        <td class="px-2 py-1 border text-xs">{{ $shippingnoteitems->shippings->costs->cities->name }}</td>
                        <td class="px-2 py-1 border text-xs">Rp. {{ $shippingnoteitems->shippings->costs->price }}</td>
                        <td class="px-2 py-1 border text-xs text-center">{{ $shippingnoteitems->shippings->quantity }}</td>
                        <td class="px-2 py-1 border text-xs">{{ $shippingnoteitems->shippings->description }}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="px-1 py-1 border text-center text-xs" colspan="10">Tidak ada data pengiriman</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Footer Section -->
        <div class="flex justify-between items-center text-xs mt-10">
            <div>
                <p class="text-right text-gray-600">Bandung, {{ \Carbon\Carbon::now()->format('d M Y') }}</p>
                <div class="h-20"></div>
                <p class="text-xs text-right text-gray-600">CV Maju Cargo</p>
            </div>
        </div>
    </div>

</body>

</html>