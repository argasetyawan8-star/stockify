@extends('layouts.app')

@section('title', 'Dashboard Staff')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
     
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Dashboard Staff Gudang
            </h1>

            <p class="text-slate-500 mt-1">
                Selamat datang,
                <span class="font-semibold">{{ auth()->user()->name }}</span>.
                Berikut aktivitas gudang hari ini.
            </p>
        </div>
    
        <div class="mt-4 lg:mt-0">
            <span
                class="inline-flex items-center px-4 py-2 rounded-xl
                bg-blue-100 text-blue-700 font-semibold">

                <i class="bi bi-calendar-event me-2"></i>

                {{ now()->translatedFormat('l, d F Y') }}

            </span>
        </div>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        {{-- Total Produk --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-slate-500 text-sm">
                        Total Produk
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800 mt-2">
                        {{ $totalProducts }}
                    </h2>

                </div>

                <div
                    class="w-14 h-14 rounded-xl
                    bg-blue-100 flex items-center justify-center">

                    <i class="bi bi-box-seam text-2xl text-blue-600"></i>

                </div>

            </div>

        </div>

        {{-- Stock In Hari Ini --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-slate-500 text-sm">
                        Stock In Hari Ini
                    </p>

                    <h2 class="text-3xl font-bold text-green-600 mt-2">
                        {{ $stockInToday }}
                    </h2>

                </div>

                <div
                    class="w-14 h-14 rounded-xl
                    bg-green-100 flex items-center justify-center">

                    <i class="bi bi-box-arrow-in-down text-2xl text-green-600"></i>

                </div>

            </div>

        </div>

        {{-- Stock Out Hari Ini --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-slate-500 text-sm">
                        Stock Out Hari Ini
                    </p>

                    <h2 class="text-3xl font-bold text-red-600 mt-2">
                        {{ $stockOutToday }}
                    </h2>

                </div>

                <div
                    class="w-14 h-14 rounded-xl
                    bg-red-100 flex items-center justify-center">

                    <i class="bi bi-box-arrow-up text-2xl text-red-600"></i>

                </div>

            </div>

        </div>

        {{-- Low Stock --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-slate-500 text-sm">
                        Low Stock
                    </p>

                    <h2 class="text-3xl font-bold text-amber-600 mt-2">
                        {{ $lowStocks }}
                    </h2>

                </div>

                <div
                    class="w-14 h-14 rounded-xl
                    bg-amber-100 flex items-center justify-center">

                    <i class="bi bi-exclamation-triangle text-2xl text-amber-600"></i>

                </div>

            </div>

        </div>

    </div>

        {{-- Recent Transaction --}}
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        {{-- Stock In --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

            <div class="border-b px-6 py-4">
                <h2 class="font-semibold text-slate-700">
                    <i class="bi bi-box-arrow-in-down text-green-600 me-2"></i>
                    Stock In Terbaru
                </h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left">Tanggal</th>
                            <th class="px-5 py-3 text-left">Produk</th>
                            <th class="px-5 py-3 text-center">Qty</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentStockIns as $item)

                            <tr class="border-t">

                                <td class="px-5 py-3">
                                    {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                </td>

                                <td class="px-5 py-3">
                                    {{ $item->product->name ?? '-' }}
                                </td>

                                <td class="px-5 py-3 text-center text-green-600 font-bold">
                                    +{{ $item->qty }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3"
                                    class="py-6 text-center text-slate-400">

                                    Belum ada data.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        {{-- Stock Out --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

            <div class="border-b px-6 py-4">
                <h2 class="font-semibold text-slate-700">
                    <i class="bi bi-box-arrow-up text-red-600 me-2"></i>
                    Stock Out Terbaru
                </h2>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-5 py-3 text-left">Tanggal</th>
                            <th class="px-5 py-3 text-left">Produk</th>
                            <th class="px-5 py-3 text-center">Qty</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentStockOuts as $item)

                            <tr class="border-t">

                                <td class="px-5 py-3">
                                    {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}
                                </td>

                                <td class="px-5 py-3">
                                    {{ $item->product->name ?? '-' }}
                                </td>

                                <td class="px-5 py-3 text-center text-red-600 font-bold">
                                    -{{ $item->qty }}
                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="3"
                                    class="py-6 text-center text-slate-400">

                                    Belum ada data.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Quick Menu --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">

        <h2 class="font-semibold text-slate-700 mb-5">
            Quick Menu
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <a href="{{ route('stock-ins.create') }}"
               class="rounded-xl bg-green-500 hover:bg-green-600 text-white p-5 transition">

                <i class="bi bi-box-arrow-in-down text-3xl"></i>

                <h3 class="mt-3 font-semibold">
                    Input Stock In
                </h3>

            </a>

            <a href="{{ route('stock-outs.create') }}"
               class="rounded-xl bg-red-500 hover:bg-red-600 text-white p-5 transition">

                <i class="bi bi-box-arrow-up text-3xl"></i>

                <h3 class="mt-3 font-semibold">
                    Input Stock Out
                </h3>

            </a>

            <a href="{{ route('products.index') }}"
               class="rounded-xl bg-blue-600 hover:bg-blue-700 text-white p-5 transition">

                <i class="bi bi-box-seam text-3xl"></i>

                <h3 class="mt-3 font-semibold">
                    Lihat Produk
                </h3>

            </a>

        </div>

    </div>

    {{-- Low Stock --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200">

        <div class="border-b px-6 py-4">

            <h2 class="font-semibold text-slate-700">

                <i class="bi bi-exclamation-triangle text-amber-500 me-2"></i>

                Produk Hampir Habis

            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-3 text-left">Produk</th>
                        <th class="px-5 py-3 text-center">Stock</th>
                        <th class="px-5 py-3 text-center">Minimum</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($lowStockProducts as $product)

                        <tr class="border-t">

                            <td class="px-5 py-3">
                                {{ $product->name }}
                            </td>

                            <td class="px-5 py-3 text-center">

                                <span class="text-red-600 font-bold">

                                    {{ $product->stock }}

                                </span>

                            </td>

                            <td class="px-5 py-3 text-center">

                                {{ $product->minimum_stock }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="3"
                                class="py-6 text-center text-green-600 font-medium">

                                Semua stok masih aman.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection