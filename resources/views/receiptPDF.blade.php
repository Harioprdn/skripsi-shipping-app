<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi Pengiriman</title>
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
                <h2 class="text-xl font-semibold text-gray-800">Resi Pengiriman Barang</h2>
                <p class="text-sm text-gray-600"><span id="date">{{ $receipt->date }}</span></p>
                <p class="text-sm text-gray-600"><span id="receipt-number">{{ $receipt->number }}</span></p>
            </div>
        </div>

        <!-- Sender and Receiver Information -->
        <div class="flex justify-between mb-4">
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Pengirim</h3>
                <p class="text-sm text-gray-600">Nama: <span id="sender-name">{{ $receipt->sender_name }}</span></p>
                <p class="text-sm text-gray-600">Alamat: <span id="sender-address">{{ $receipt->sender_address }}</span></p>
                <p class="text-sm text-gray-600">Telp: <span id="sender-phone">{{ $receipt->sender_phone }}</span></p>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-gray-800">Penerima</h3>
                <p class="text-sm text-gray-600">Nama: <span id="receiver-name">{{ $receipt->receiver_name }}</span></p>
                <p class="text-sm text-gray-600">Alamat: <span id="receiver-address">{{ $receipt->receiver_address }}</span></p>
                <p class="text-sm text-gray-600">Telp: <span id="receiver-phone">{{ $receipt->receiver_phone }}</span></p>
            </div>
        </div>

        <!-- Package Information -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Barang</h3>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                <div>
                    <p>Jenis Barang: <span id="item-description">{{ $receipt->items->name }}</span></p>
                    <p>Berat: <span id="weight">{{ $receipt->item_weight }}</span></p>
                </div>
                <div>
                    <p>Kota Tujuan: <span id="destination-city">{{ $receipt->costs->cities->name }}</span></p>
                </div>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Informasi Pembayaran</h3>
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600">
                <div>
                    <p>Dibayar Oleh: <span id="payment-by">{{ $receipt->payment }}</span></p>
                    <p>Biaya Pengiriman: Rp. <span id="payment-status">{{ $receipt->costs->price }}</span></p>
                </div>
            </div>
        </div>

        <!-- Additional Notes -->
        <div class="mb-4">
            <h3 class="text-lg font-semibold text-gray-800">Keterangan</h3>
            <p class="text-sm text-gray-600" id="additional-notes">{{ $receipt->description }}</p>
        </div>

        <!-- Footer Section -->
        <div class="border-t pt-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-600">Terima kasih telah melakukan pengiriman bersama kami!</p>
                    <p class="text-sm text-gray-600">Jika ingin memberikan pertanyaan, silahkan hubungi kami.</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600">Email: <a href="mailto:support@company.com" class="text-blue-500">majucargo@gmail.com</a></p>
                    <p class="text-sm text-gray-600">Website: <a href="https://www.company.com" class="text-blue-500">www.majucargo.com</a></p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>