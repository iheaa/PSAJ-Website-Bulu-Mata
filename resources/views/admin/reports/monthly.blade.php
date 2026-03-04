<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan {{ $monthName }}</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            font-size: 12px;
            color: #111827;
            margin: 0;
            padding: 24px;
        }

        h1,
        h2,
        h3 {
            margin: 0;
        }

        .text-muted {
            color: #6B7280;
        }

        .badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 999px;
            font-size: 10px;
            background: #EEF2FF;
            color: #4F46E5;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }

        th,
        td {
            padding: 8px 10px;
            border-bottom: 1px solid #E5E7EB;
            text-align: left;
        }

        th {
            background: #F9FAFB;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #6B7280;
        }

        tfoot td {
            border-top: 2px solid #111827;
            font-weight: 700;
        }

        .text-right {
            text-align: right;
        }

        .mt-2 {
            margin-top: 8px;
        }

        .mt-6 {
            margin-top: 24px;
        }

        .mb-2 {
            margin-bottom: 8px;
        }

        .mb-4 {
            margin-bottom: 16px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 16px;
        }

        .header-left {
            max-width: 60%;
        }

        .small {
            font-size: 11px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-left">
            <h1>Laporan Penjualan Bulanan</h1>
            <p class="text-muted small">Narita Lashes</p>
            <p class="text-muted small">Periode: {{ $monthName }}</p>
        </div>
        <div class="text-right">
            <span class="badge">Admin Report</span>
            <p class="text-muted small mt-2">Generated at: {{ now('Asia/Jakarta')->format('d M Y H:i') }} WIB</p>
        </div>
    </div>

    <div class="mt-2">
        <h2 class="small mb-2">Ringkasan</h2>
        <p class="small">Total pendapatan bulan ini: <strong>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong>
        </p>
    </div>

    <div class="mt-6">
        <h2 class="small mb-2">Produk Terjual</h2>
        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th class="text-right">Qty Terjual</th>
                    <th class="text-right">Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td class="text-right">{{ (int) $item->total_quantity }}</td>
                    <td class="text-right">Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-muted small">Belum ada transaksi untuk periode ini.</td>
                </tr>
                @endforelse
            </tbody>
            @if($items->count() > 0)
            <tfoot>
                <tr>
                    <td>Total</td>
                    <td></td>
                    <td class="text-right">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</body>

</html>

