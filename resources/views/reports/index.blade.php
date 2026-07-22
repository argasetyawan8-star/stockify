@extends('layouts.app')

@section('title', 'Laporan Transaksi')

@section('content')

<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Laporan Transaksi
            </h1>

            <p class="text-slate-500 mt-1">
                Data Stock In dan Stock Out
            </p>
        </div>

        <a href="{{ route('reports.pdf') }}"
           class="px-5 py-3 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">

            Export PDF

        </a>
    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-2xl shadow border border-slate-200 p-5 mb-6">

        <form method="GET">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <div>
                    <label class="font-semibold text-slate-700">
                        Jenis
                    </label>

                    <select
                        name="type"
                        class="w-full mt-2 rounded-xl border-slate-300">

                        <option value="">Semua</option>

                        <option value="IN"
                            {{ request('type')=='IN' ? 'selected' : '' }}>
                            Stock In
                        </option>

                        <option value="OUT"
                            {{ request('type')=='OUT' ? 'selected' : '' }}>
                            Stock Out
                        </option>

                    </select>
                </div>

                <div>
                    <label class="font-semibold text-slate-700">
                        Dari Tanggal
                    </label>

                    <input
                        type="date"
                        name="start_date"
                        value="{{ request('start_date') }}"
                        class="w-full mt-2 rounded-xl border-slate-300">
                </div>

                <div>
                    <label class="font-semibold text-slate-700">
                        Sampai
                    </label>

                    <input
                        type="date"
                        name="end_date"
                        value="{{ request('end_date') }}"
                        class="w-full mt-2 rounded-xl border-slate-300">
                </div>

                <div class="flex items-end">

                    <button
                        class="w-full bg-blue-600 text-white rounded-xl py-3 hover:bg-blue-700">

                        Filter

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow border border-slate-200 overflow-hidden">

        <table class="min-w-full">

            <thead class="bg-slate-100">

            <tr>

                <th class="px-5 py-3 text-left">No</th>

                <th class="px-5 py-3 text-left">Tanggal</th>

                <th class="px-5 py-3 text-left">Produk</th>

                <th class="px-5 py-3 text-center">Jenis</th>

                <th class="px-5 py-3 text-center">Qty</th>

                <th class="px-5 py-3 text-left">Catatan</th>

            </tr>

            </thead>

            <tbody>

            @forelse($transactions as $transaction)

                <tr class="border-t hover:bg-slate-50">

                    <td class="px-5 py-3">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-5 py-3">
                        {{ \Carbon\Carbon::parse($transaction['date'])->format('d M Y') }}
                    </td>

                    <td class="px-5 py-3">

                        {{ $transaction['product']->name }}

                    </td>

                    <td class="px-5 py-3 text-center">

                        @if($transaction['type']=='IN')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm">

                                Stock In

                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm">

                                Stock Out

                            </span>

                        @endif

                    </td>

                    <td class="px-5 py-3 text-center font-bold">

                        {{ $transaction['qty'] }}

                    </td>

                    <td class="px-5 py-3">

                        {{ $transaction['note'] ?? '-' }}

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-8 text-slate-500">

                        Belum ada data.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection