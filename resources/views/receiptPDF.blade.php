<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi Pengiriman Barang</title>
</head>

<body>
    <div class="container">
        <h1>Resi Pengiriman Barang</h1>
        <div class="info">
            <p><strong>Nomor Resi:</strong> {{ $receipt->number }}</p>
            <p><strong>Nama Pengirim:</strong> {{ $receipt->sender_name }}</p>
            <p><strong>Alamat Pengirim:</strong> {{ $receipt->sender_address }}</p>
            <p><strong>Nomor Telepon Pengirim:</strong> {{ $receipt->sender_phone }}</p>
            <p><strong>Nama Penerima:</strong> {{ $receipt->receiver_name }}</p>
            <p><strong>Alamat Penerima:</strong> {{ $receipt->receiver_address }}</p>
            <p><strong>Nomor Telepon Penerima:</strong> {{ $receipt->receiver_phone }}</p>
            <p><strong>Berat Barang:</strong> {{ $receipt->item_weight }} kg</p>
            <p><strong>Tanggal Pemesanan:</strong> {{ $receipt->date }}</p>
            <p><strong>Biaya Pengiriman:</strong> Rp {{ number_format($receipt->costs->price, 0, ',', '.') }}</p>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
        </table>
    </div>
</body>

</html>