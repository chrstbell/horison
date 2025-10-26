<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Struk Pesanan - Horison</title>
        <style>
            body {
                font-family: 'Courier New', Courier, monospace;
                margin: 0;
                padding: 10px;
                background: white;
                color: black;
                width: 80mm;
                /* Lebar struk standar */
            }

            h2,
            h3 {
                text-align: center;
                margin-bottom: 5px;
            }

            hr {
                border: none;
                border-top: 1px dashed #000;
                margin: 10px 0;
            }

            .receipt-header {
                margin-bottom: 10px;
            }

            .receipt-info {
                margin-bottom: 10px;
                font-size: 14px;
            }

            .receipt-items {
                width: 100%;
                font-size: 13px;
                border-collapse: collapse;
            }

            .receipt-items th,
            .receipt-items td {
                padding: 4px 0;
            }

            .receipt-items th {
                border-bottom: 1px solid #000;
                text-align: left;
            }

            .receipt-items td.qty,
            .receipt-items td.price {
                text-align: right;
                min-width: 40px;
            }

            .receipt-total {
                margin-top: 10px;
                font-weight: bold;
                font-size: 14px;
                display: flex;
                justify-content: space-between;
            }

            .receipt-notes {
                margin-top: 10px;
                font-style: italic;
                font-size: 12px;
            }

            .receipt-footer {
                margin-top: 20px;
                text-align: center;
                font-size: 11px;
            }

            @media print {
                body {
                    width: 80mm;
                    margin: 0;
                    padding: 0;
                }
            }
        </style>
    </head>

    <body>
        <div class="receipt-header">
            <h2>HORISON HOTEL</h2>
            <h3>STRUK PESANAN F&B</h3>
        </div>
        <hr />
        <div class="receipt-info">
            <div><strong>Pesanan #:</strong> {{ $receiptData["orderId"] }}</div>
            <div><strong>Kamar:</strong> {{ $receiptData["room"] }}</div>
            <div><strong>Waktu Pesan:</strong> {{ $receiptData["time"] }}</div>
            <div><strong>Status:</strong> {{ ucfirst($receiptData["status"]) }}</div>
        </div>
        <hr />
        <table class="receipt-items">
            <thead>
                <tr>
                    <th>Menu</th>
                    <th class="qty">Qty</th>
                    <th class="price">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($receiptData["items"] as $item)
                    <tr>
                        <td>
                            {{ $item["name"] }}
                            @if (!empty($item["notes"]))
                                <br><small style="font-style: italic; font-size: 11px;">Note:
                                    {{ $item["notes"] }}</small>
                            @endif
                        </td>
                        <td class="qty">{{ $item["quantity"] }}</td>
                        <td class="price">Rp {{ number_format($item["price"] * $item["quantity"], 0, ",", ".") }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr />
        <div class="receipt-total">
            <div>Subtotal:</div>
            <div>Rp {{ number_format($receiptData["subtotal"], 0, ",", ".") }}</div>
        </div>
        <div class="receipt-total" style="font-size: 16px;">
            <div>TOTAL:</div>
            <div>Rp {{ number_format($receiptData["total"], 0, ",", ".") }}</div>
        </div>
        @if (!empty($receiptData["notes"]))
            <div class="receipt-notes">Catatan: {{ $receiptData["notes"] }}</div>
        @endif
        <hr />
        <div class="receipt-footer">
            Terima kasih atas pesanan Anda!<br />
            Selamat Menikmati!
        </div>

        <script>
            // Auto print when page loads
            window.addEventListener('load', () => {
                window.print();
            });
        </script>
    </body>

</html>
