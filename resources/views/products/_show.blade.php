@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Detail Produk
            </h1>

            <p class="text-slate-500 mt-1">
                Informasi lengkap mengenai produk.
            </p>
        </div>

        <a href="{{ route('products.index') }}"
            class="inline-flex items-center px-4 py-2 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 transition">

            <i class="bi bi-arrow-left mr-2"></i>

            Kembali

        </a>

    </div>


    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- Header Card --}}
        <div class="px-6 py-5 border-b border-slate-200 flex items-center justify-between">

            <div>

                <h2 class="text-2xl font-bold text-slate-800">
                    {{ $product->name }}
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    SKU : {{ $product->sku }}
                </p>

            </div>

            @can('manage products')

<a href="{{ route('products.edit', $product->id) }}"
    class="inline-flex items-center px-4 py-2 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white transition">

    <i class="bi bi-pencil-square mr-2"></i>

    Edit Produk

</a>

@endcan

        </div>



        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">

            {{-- Informasi Produk --}}
            <div class="lg:col-span-2">

                <h3 class="text-lg font-semibold text-slate-800 mb-4">
                    Informasi Produk
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <p class="text-sm text-slate-500">Kategori</p>
                        <p class="font-medium text-slate-800">
                            {{ $product->category->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Supplier</p>
                        <p class="font-medium text-slate-800">
                            {{ $product->supplier->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Harga Beli</p>
                        <p class="font-medium text-slate-800">
                            Rp {{ number_format($product->purchase_price,0,',','.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Harga Jual</p>
                        <p class="font-medium text-slate-800">
                            Rp {{ number_format($product->selling_price,0,',','.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Minimum Stock</p>
                        <p class="font-medium text-slate-800">
                            {{ $product->minimum_stock }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">Stok Saat Ini</p>
                        <p class="font-medium text-slate-800">
                            {{ $product->stock ?? 0 }}
                        </p>
                    </div>

                </div>

                {{-- Deskripsi --}}
                <div class="mt-6">

                    <h3 class="text-lg font-semibold text-slate-800 mb-2">
                        Deskripsi
                    </h3>

                    <div class="bg-slate-50 rounded-xl p-4 text-slate-700">

                        {{ $product->description ?: 'Tidak ada deskripsi.' }}

                    </div>

                </div>


                {{-- Attribute --}}
                <div class="mt-8">

                    <h3 class="text-lg font-semibold text-slate-800 mb-4">
                        Atribut Produk
                    </h3>

                    @if($product->attributes->count())

                        <div class="overflow-x-auto">

                            <table class="min-w-full">

                                <thead>

                                    <tr class="bg-slate-100">

                                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">
                                            Nama Attribute
                                        </th>

                                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">
                                            Nilai
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @foreach($product->attributes as $attribute)

                                        <tr class="border-b border-slate-200">

                                            <td class="px-4 py-3">

                                                {{ $attribute->attribute_name }}

                                            </td>

                                            <td class="px-4 py-3">

                                                {{ $attribute->attribute_value }}

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @else

                        <div class="bg-slate-50 rounded-xl p-6 text-center">

                            <i class="bi bi-box text-4xl text-slate-300"></i>

                            <p class="mt-3 text-slate-500">

                                Produk ini belum memiliki atribut.

                            </p>

                        </div>

                    @endif

                </div>

            </div>



            {{-- Gambar Produk --}}
            <div>

                <h3 class="text-lg font-semibold text-slate-800 mb-4">
                    Gambar Produk
                </h3>

                @if($product->image)

                    <img
                        src="{{ asset('storage/'.$product->image) }}"
                        alt="{{ $product->name }}"
                        class="w-full rounded-xl border border-slate-200 shadow-sm">

                @else

                    <div class="h-72 rounded-xl border-2 border-dashed border-slate-300 flex flex-col items-center justify-center">

                        <i class="bi bi-image text-5xl text-slate-300"></i>

                        <p class="text-slate-500 mt-3">
                            Belum ada gambar.
                        </p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@endsection