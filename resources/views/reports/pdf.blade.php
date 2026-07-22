<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Stockify</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th {
            background: #e5e7eb;
        }

        th,
        td {
            padding: 8px;
        }

        td.center {
            text-align: center;
        }

        td.right {
            text-align: right;
        }
    </style>

</head>

<body>

    <h2>Laporan Transaksi Barang</h2>

    <p>
        Stockify - Sistem Manajemen Stok Barang
    </p>

    <table>

        <thead>

            <tr>

                <th width="40">No</th>

                <th width="90">Tanggal</th>

                <th>Produk</th>

                <th width="70">Jenis</th>

                <th width="70">Qty</th>

                <th>Keterangan</th>

            </tr>

        </thead>

        <tbody>

            @forelse($transactions as $transaction)

                <tr>

                    <td class="center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="center">
                        {{ \Carbon\Carbon::parse($transaction['date'])->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $transaction['product']->name ?? '-' }}
                    </td>

                    <td class="center">

                        @if($transaction['type'] == 'IN')
                            Barang Masuk
                        @else
                            Barang Keluar
                        @endif

                    </td>

                    <td class="center">
                        {{ $transaction['qty'] }}
                    </td>

                    <td>
                        {{ $transaction['note'] ?? '-' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="center">
                        Tidak ada data.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <br><br>

    <table style="border:none">

        <tr style="border:none">

            <td style="border:none; text-align:right">

                Dicetak pada :
                {{ now()->format('d-m-Y H:i') }}

            </td>

        </tr>

    </table>

</body>

</html>