@extends('layouts.app')

@section('title','Detail Stock Opname')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

        <h2 class="text-2xl font-bold mb-8">

            Detail Stock Opname

        </h2>

        <div class="grid md:grid-cols-2 gap-6">

            <div>

                <label class="text-sm text-slate-500">
                    Produk
                </label>

                <p class="font-semibold text-lg">

                    {{ $stockOpname->product->name }}

                </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">
                    Petugas
                </label>

                <p class="font-semibold text-lg">

                    {{ $stockOpname->user->name }}

                </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">
                    Stok Sistem
                </label>

                <p class="font-semibold text-lg">

                    {{ $stockOpname->system_stock }}

                </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">
                    Stok Fisik
                </label>

                <p class="font-semibold text-lg">

                    {{ $stockOpname->physical_stock }}

                </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">
                    Selisih
                </label>

                <p class="font-semibold text-lg">

                    {{ $stockOpname->difference }}

                </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">
                    Tanggal
                </label>

                <p class="font-semibold text-lg">

                    {{ $stockOpname->created_at->format('d M Y H:i') }}

                </p>

            </div>

        </div>

        <div class="mt-8">

            <label class="text-sm text-slate-500">
                Catatan
            </label>

            <div class="mt-2 p-4 rounded-xl bg-slate-100">

                {{ $stockOpname->notes ?: '-' }}

            </div>

        </div>

        <div class="mt-8">

            <a href="{{ route('stock-opnames.index') }}"
                class="px-5 py-3 bg-slate-600 text-white rounded-xl hover:bg-slate-700">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection