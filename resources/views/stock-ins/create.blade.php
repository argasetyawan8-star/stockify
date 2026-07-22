@extends('layouts.app')

@section('title','Tambah Stock In')

@section('content')

<div class="p-6">


    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Tambah Stock In
            </h1>

            <p class="text-slate-500 mt-1">
                Tambahkan barang masuk ke gudang.
            </p>

        </div>


        <a href="{{ route('stock-ins.index') }}"
           class="px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300">

            <i class="bi bi-arrow-left"></i>
            Kembali

        </a>


    </div>



    {{-- Card --}}

    <div class="bg-white rounded-2xl shadow border border-slate-200">


        <form action="{{ route('stock-ins.store') }}"
              method="POST"
              class="p-8">


            @csrf



            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">



                {{-- Product --}}

                <div>

                    <label class="block mb-2 font-semibold text-slate-700">
                        Produk
                    </label>


                    <select
                        name="product_id"
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">


                        <option value="">
                            -- Pilih Produk --
                        </option>


                        @foreach($products as $product)


                            <option value="{{ $product->id }}"
                                {{ old('product_id') == $product->id ? 'selected':'' }}>


                                {{ $product->name }}


                            </option>


                        @endforeach


                    </select>


                    @error('product_id')

                    <p class="text-sm text-red-500 mt-1">

                        {{ $message }}

                    </p>

                    @enderror


                </div>





                {{-- Qty --}}

                <div>


                    <label class="block mb-2 font-semibold text-slate-700">

                        Jumlah Masuk

                    </label>


                    <input
                        type="number"
                        name="qty"
                        min="1"
                        value="{{ old('qty') }}"
                        placeholder="Contoh: 10"
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">


                    @error('qty')

                    <p class="text-sm text-red-500 mt-1">

                        {{ $message }}

                    </p>

                    @enderror


                </div>





                {{-- Date --}}

                <div>


                    <label class="block mb-2 font-semibold text-slate-700">

                        Tanggal Masuk

                    </label>


                    <input
                        type="date"
                        name="date"
                        value="{{ old('date',date('Y-m-d')) }}"
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">


                    @error('date')

                    <p class="text-sm text-red-500 mt-1">

                        {{ $message }}

                    </p>

                    @enderror


                </div>





                {{-- Reference --}}

                <div>


                    <label class="block mb-2 font-semibold text-slate-700">

                        Reference

                    </label>


                    <input
                        type="text"
                        name="reference"
                        value="{{ old('reference') }}"
                        placeholder="Nomor nota / supplier"
                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">


                    @error('reference')

                    <p class="text-sm text-red-500 mt-1">

                        {{ $message }}

                    </p>

                    @enderror


                </div>


            </div>





            {{-- Note --}}

            <div class="mt-6">


                <label class="block mb-2 font-semibold text-slate-700">

                    Catatan

                </label>



                <textarea
                    name="note"
                    rows="4"
                    placeholder="Catatan tambahan..."
                    class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('note') }}</textarea>



                @error('note')

                <p class="text-sm text-red-500 mt-1">

                    {{ $message }}

                </p>

                @enderror



            </div>





            {{-- Button --}}

            <div class="flex justify-end gap-3 mt-8">


                <a href="{{ route('stock-ins.index') }}"
                   class="px-6 py-3 rounded-xl bg-slate-500 text-white hover:bg-slate-600">


                    Batal


                </a>




                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white">


                    <i class="bi bi-save"></i>

                    Simpan Stock In


                </button>


            </div>




        </form>


    </div>


</div>


@endsection