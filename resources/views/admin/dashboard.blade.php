@extends('layouts.admin')

@section('content')
<div class="mb-6 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="mt-2 text-sm text-gray-600">Ringkasan performa katalog dan penjualan Narita Lashes.</p>
    </div>
    <form method="GET" class="flex flex-wrap items-center gap-2">
        @php
        $months = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
        ];
        $currentYear = now('Asia/Jakarta')->year;
        @endphp
        <div class="flex items-center gap-2">
            <select name="month"
                class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach($months as $m => $label)
                <option value="{{ $m }}" {{ $m == $selectedMonth ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <select name="year"
                class="rounded-md border-gray-300 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                @for($y = $currentYear; $y >= $currentYear - 4; $y--)
                <option value="{{ $y }}" {{ $y == $selectedYear ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>
        </div>
        <button type="submit"
            class="inline-flex items-center px-3 py-1.5 rounded-md bg-indigo-600 text-white text-xs font-semibold hover:bg-indigo-700">
            Terapkan
        </button>
    </form>
</div>

<div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
    <!-- Stat Card -->
    <!-- Total Catalogs -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Catalogs</dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">{{ $totalCatalogs }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('admin.catalogs.index') }}"
                    class="font-medium text-indigo-600 hover:text-indigo-500">View all</a>
            </div>
        </div>
    </div>

    <!-- Total Items Sold -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Total Items Sold</dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">{{ $totalItemsSold }}</div>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                </div>
                <div class="ml-5 w-0 flex-1">
                    <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">Pendapatan Bulan Ini</dt>
                        <dd>
                            <div class="text-lg font-medium text-gray-900">Rp
                                {{ number_format($monthlyRevenue, 0, ',', '.') }}</div>
                            <p class="mt-1 text-xs text-gray-400">{{ $selectedMonthName }}</p>
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <div class="bg-gray-50 px-5 py-3">
            <div class="text-sm">
                <a href="{{ route('admin.orders.export') }}"
                    class="font-medium text-green-600 hover:text-green-500">Download Bulanan (.xlsx)</a>
            </div>
        </div>
    </div>
</div>

{{-- Revenue Chart + Reports --}}
<div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="bg-white overflow-hidden shadow rounded-lg lg:col-span-2">
        <div class="p-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-semibold text-gray-800 tracking-wide uppercase">Pendapatan per Bulan</h2>
                <span class="text-xs text-gray-400">Tahun {{ $selectedYear }}</span>
            </div>
            <div class="h-64">
                <canvas id="revenueChart"></canvas>
            </div>
            @if(empty($revenueLabels) || count($revenueLabels) === 0)
            <p class="mt-4 text-xs text-gray-400 text-center">Belum ada data pendapatan untuk tahun ini.</p>
            @endif
        </div>
    </div>

    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="p-5 space-y-4">
            <h2 class="text-sm font-semibold text-gray-800 tracking-wide uppercase">Laporan Bulanan</h2>
            <p class="text-sm text-gray-600">Unduh laporan pendapatan dan produk terjual dalam format PDF untuk bulan terpilih.</p>
            <a href="{{ route('admin.orders.monthlyPdf', ['month' => $selectedMonth, 'year' => $selectedYear]) }}"
                class="inline-flex items-center justify-center px-4 py-2.5 border border-gray-200 rounded-md text-sm font-semibold text-gray-700 bg-gray-50 hover:bg-gray-100">
                Download Laporan Bulan Ini (PDF)
            </a>
            <p class="text-xs text-gray-400">File berisi daftar produk terjual dan total pendapatan untuk bulan terpilih.</p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const labels = @json($revenueLabels ?? []);
        const data = @json($revenueData ?? []);

        if (!labels.length || !data.length) return;

        const ctx = document.getElementById('revenueChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: data,
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79,70,229,0.08)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4,
                    pointBackgroundColor: '#4F46E5',
                    pointBorderWidth: 1,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        ticks: {
                            callback: function (value) {
                                return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection