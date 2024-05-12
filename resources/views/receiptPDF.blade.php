<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resi Pengiriman</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'Nunito', sans-serif;
            margin: 1.25in;
            font-size: 0.875rem;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 1rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .header h1 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .info-table th,
        .info-table td {
            border: 1px solid #e2e8f0;
            padding: 0.5rem;
        }

        .info-table th {
            background-color: #f7fafc;
            font-weight: bold;
            text-align: left;
        }

        .info-table td {
            text-align: left;
        }

        .footer {
            text-align: center;
            margin-top: 2rem;
        }

        .footer p {
            font-size: 0.75rem;
            color: #a0aec0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Resi Pengiriman</h1>
            <p>{{ date('Y-m-d H:i:s') }}</p>
        </div>
        <table class="info-table">
            <thead>
                <tr>
                    <th>Nomor Resi</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Penerima</th>
                    <th>Penerima</th>
                    <th>Penerima</th>
                    <th>Penerima</th>
                    <th>Penerima</th>
                    <th>Penerima</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $receipt->number }}</td>
                    <td>{{ $receipt->sender_name }}</td>
                    <td>{{ $receipt->receiver_name }}</td>
                </tr>
                <!-- Tambahkan baris tambahan sesuai kebutuhan -->
            </tbody>
        </table>
        <div class="footer">
            <p>Terima kasih telah menggunakan layanan kami.</p>
        </div>
    </div>
</body>

</html>