@extends('layouts.app')

@section('title', 'Dashboard Manager')

@section('content')

<div class="space-y-8">

    {{-- ================= HEADER ================= --}}

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Dashboard Manajer Gudang
            </h1>

            <p class="text-slate-500 mt-2">
                Selamat datang,
                <span class="font-semibold">
                    {{ Auth::user()->name }}
                </span>
                
            </p>

        </div>

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm px-6 py-4">

            <p class="text-sm text-slate-500">
                Hari Ini
            </p>

            <h3 class="text-lg font-bold text-slate-800">
                {{ now()->translatedFormat('l, d F Y') }}
            </h3>

        </div>

    </div>





    {{-- ================= STATISTIC CARD ================= --}}

    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- Total Product --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Total Produk
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $totalProducts }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-blue-100 flex items-center justify-center">

                    <i class="bi bi-box-seam text-2xl text-blue-600"></i>

                </div>

            </div>

        </div>





        {{-- Total Stock --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Total Stock
                    </p>

                    <h2 class="text-3xl font-bold text-purple-600 mt-2">
                        {{ number_format($totalStock) }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-purple-100 flex items-center justify-center">

                    <i class="bi bi-boxes text-2xl text-purple-600"></i>

                </div>

            </div>

        </div>





        {{-- Stock In Today --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Barang Masuk Hari Ini
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $stockInToday }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">

                    <i class="bi bi-box-arrow-in-down text-2xl text-green-600"></i>

                </div>

            </div>

        </div>





        {{-- Stock Out Today --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Barang Keluar Hari Ini
                    </p>

                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $stockOutToday }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">

                    <i class="bi bi-box-arrow-up text-2xl text-red-600"></i>

                </div>

            </div>

        </div>





        {{-- Low Stock --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Stok Menipis
                    </p>

                    <h2 class="text-3xl font-bold text-orange-600 mt-2">
                        {{ $lowStockCount }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-orange-100 flex items-center justify-center">

                    <i class="bi bi-exclamation-triangle text-2xl text-orange-600"></i>

                </div>

            </div>

        </div>





        {{-- Safe Stock --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Stok Aman
                    </p>

                    <h2 class="text-3xl font-bold text-emerald-600 mt-2">
                        {{ $safeStock }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-emerald-100 flex items-center justify-center">

                    <i class="bi bi-check-circle text-2xl text-emerald-600"></i>

                </div>

            </div>

        </div>





        {{-- Pending Stock In --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Pending Stock In
                    </p>

                    <h2 class="text-3xl font-bold text-amber-600 mt-2">
                        {{ $pendingStockIn }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-amber-100 flex items-center justify-center">

                    <i class="bi bi-hourglass-split text-2xl text-amber-600"></i>

                </div>

            </div>

        </div>





        {{-- Pending Stock Out --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Pending Stock Out
                    </p>

                    <h2 class="text-3xl font-bold text-rose-600 mt-2">
                        {{ $pendingStockOut }}
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-xl bg-rose-100 flex items-center justify-center">

                    <i class="bi bi-clock-history text-2xl text-rose-600"></i>

                </div>

            </div>

        </div>

    </div>
        {{-- ================= CHART & LOW STOCK ================= --}}

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Chart --}}
        <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <div class="flex items-center justify-between mb-6">

                <h3 class="text-lg font-semibold text-slate-700">
                    Grafik Stock Masuk & Keluar
                </h3>

                <span class="text-sm text-slate-500">
                    Tahun {{ date('Y') }}
                </span>

            </div>

            <div class="h-96">

                <canvas id="stockChart"></canvas>

            </div>

        </div>



        {{-- Low Stock --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <div class="flex items-center justify-between mb-5">

                <h3 class="text-lg font-semibold text-slate-700">

                    Stok Menipis

                </h3>

                <span class="text-red-500 text-sm">

                    {{ $lowStocks->count() }} Produk

                </span>

            </div>

            @forelse($lowStocks as $product)

                <div class="flex items-center justify-between py-3 border-b last:border-none">

                    <div>

                        <div class="font-medium text-slate-700">

                            {{ $product->name }}

                        </div>

                        <div class="text-xs text-slate-500">

                            Minimal {{ $product->minimum_stock }}

                        </div>

                    </div>

                    <span
                        class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-sm font-semibold">

                        {{ $product->stock }}

                    </span>

                </div>

            @empty

                <div class="text-center py-10 text-slate-400">

                    Tidak ada produk dengan stok menipis.

                </div>

            @endforelse

        </div>

    </div>





    {{-- ================= TRANSAKSI TERBARU ================= --}}

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

        <div class="flex items-center justify-between mb-6">

            <h3 class="text-lg font-semibold text-slate-700">

                Transaksi Terbaru

            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead>

                    <tr class="border-b bg-slate-50">

                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">

                            Tanggal

                        </th>

                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">

                            Produk

                        </th>

                        <th class="px-4 py-3 text-center text-sm font-semibold text-slate-600">

                            Jenis

                        </th>

                        <th class="px-4 py-3 text-center text-sm font-semibold text-slate-600">

                            Qty

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentTransactions as $trx)

                        <tr class="border-b hover:bg-slate-50">

                            <td class="px-4 py-3">

                                {{ \Carbon\Carbon::parse($trx->created_at)->format('d M Y') }}

                            </td>

                            <td class="px-4 py-3">

                                {{ $trx->product->name ?? '-' }}

                            </td>

                            <td class="px-4 py-3 text-center">

                                @if($trx instanceof \App\Models\StockIn)

                                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">

                                        Stock In

                                    </span>

                                @else

                                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs">

                                        Stock Out

                                    </span>

                                @endif

                            </td>

                            <td class="px-4 py-3 text-center font-semibold">

                                {{ $trx->qty }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="4" class="text-center py-8 text-slate-400">

                                Belum ada transaksi.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>




    {{-- ================= BOTTOM GRID ================= --}}

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                {{-- ================= TOP PRODUCT & SUPPLIER ================= --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            {{-- Top Product --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">

                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold text-slate-700">
                        Produk Paling Banyak Keluar
                    </h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">

                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-5 py-3 text-left text-sm font-semibold">
                                    Produk
                                </th>

                                <th class="px-5 py-3 text-right text-sm font-semibold">
                                    Qty
                                </th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($topProducts as $product)

                                <tr class="border-t hover:bg-slate-50">

                                    <td class="px-5 py-4">
                                        {{ $product->name }}
                                    </td>

                                    <td class="px-5 py-4 text-right font-semibold text-blue-600">
                                        {{ number_format($product->total_qty) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="2" class="py-6 text-center text-slate-500">
                                        Belum ada data
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>
                </div>

            </div>

            {{-- Supplier --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">

                <div class="px-6 py-4 border-b">
                    <h2 class="font-semibold text-slate-700">
                        Supplier Terbaru
                    </h2>
                </div>

                <div class="divide-y">

                    @forelse($latestSuppliers as $supplier)

                        <div class="px-6 py-4 flex justify-between items-center">

                            <div>

                                <p class="font-medium">
                                    {{ $supplier->name }}
                                </p>

                                <small class="text-slate-500">
                                    {{ $supplier->phone }}
                                </small>

                            </div>

                            <span class="text-xs text-slate-400">
                                {{ $supplier->created_at->diffForHumans() }}
                            </span>

                        </div>

                    @empty

                        <div class="py-6 text-center text-slate-500">
                            Belum ada supplier
                        </div>

                    @endforelse

                </div>

            </div>

        </div>


        {{-- ================= RECENT TRANSACTION ================= --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 mt-6">

            <div class="px-6 py-4 border-b">
                <h2 class="font-semibold text-slate-700">
                    Transaksi Terbaru
                </h2>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left text-sm">
                                Produk
                            </th>

                            <th class="px-5 py-3 text-center text-sm">
                                Jenis
                            </th>

                            <th class="px-5 py-3 text-center text-sm">
                                Qty
                            </th>

                            <th class="px-5 py-3 text-right text-sm">
                                Tanggal
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentTransactions as $trx)

                            <tr class="border-t hover:bg-slate-50">

                                <td class="px-5 py-4">
                                    {{ $trx->product->name ?? '-' }}
                                </td>

                                <td class="px-5 py-4 text-center">

                                    @if($trx instanceof \App\Models\StockIn)

                                        <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                            Stock In
                                        </span>

                                    @else

                                        <span class="px-3 py-1 rounded-full text-xs bg-red-100 text-red-700">
                                            Stock Out
                                        </span>

                                    @endif

                                </td>

                                <td class="px-5 py-4 text-center">
                                    {{ $trx->qty }}
                                </td>

                                <td class="px-5 py-4 text-right text-slate-500">
                                    {{ $trx->created_at->format('d M Y') }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="py-6 text-center text-slate-500">
                                    Belum ada transaksi
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

@endsection


@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const canvas = document.getElementById('stockChart');

    if (!canvas) {
        return;
    }

    new Chart(canvas, {
        type: 'bar',

        data: {
            labels: @json($months),

            datasets: [
                {
                    label: 'Stock In',

                    data: @json($monthlyStockIn),

                    backgroundColor: '#2563eb',

                    borderRadius: 8,

                    borderSkipped: false
                },

                {
                    label: 'Stock Out',

                    data: @json($monthlyStockOut),

                    backgroundColor: '#ef4444',

                    borderRadius: 8,

                    borderSkipped: false
                }
            ]
        },

        options: {
            responsive: true,

            maintainAspectRatio: false,

            interaction: {
                intersect: false,

                mode: 'index'
            },

            plugins: {
                legend: {
                    display: true,

                    position: 'top'
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' +
                                new Intl.NumberFormat('id-ID').format(context.parsed.y);
                        }
                    }
                }
            },

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        precision: 0
                    }
                },

                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

});
</script>
