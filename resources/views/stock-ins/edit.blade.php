@extends('layouts.app')

@section('title', 'Edit Stock In')

@section('content')

<div class="p-6">


    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">


        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Edit Stock In
            </h1>


            <p class="text-slate-500 mt-1">
                Perbarui data barang masuk gudang.
            </p>

        </div>



        <a href="{{ route('stock-ins.index') }}"
           class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-slate-200 hover:bg-slate-300 transition">


            <i class="bi bi-arrow-left"></i>

            Kembali


        </a>


    </div>




    {{-- Card Form --}}

    <div class="bg-white rounded-2xl shadow-md border border-slate-200">


        <form action="{{ route('stock-ins.update',$stockIn->id) }}"
              method="POST"
              class="p-8">


            @csrf

            @method('PUT')




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



                            <option
                                value="{{ $product->id }}"

                                {{ old(
                                    'product_id',
                                    $stockIn->product_id
                                ) == $product->id ? 'selected' : '' }}>


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






                {{-- Quantity --}}

                <div>


                    <label class="block mb-2 font-semibold text-slate-700">

                        Jumlah Masuk

                    </label>




                    <input
                        type="number"
                        name="qty"
                        min="1"

                        value="{{ old(
                            'qty',
                            $stockIn->qty
                        ) }}"

                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"

                    >




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

                        value="{{ old(
                            'date',
                            \Carbon\Carbon::parse($stockIn->date)->format('Y-m-d')
                        ) }}"

                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"

                    >




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

                        value="{{ old(
                            'reference',
                            $stockIn->reference
                        ) }}"

                        placeholder="Nomor nota / kode transaksi"

                        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500"

                    >




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

                    class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old(
                        'note',
                        $stockIn->note
                    ) }}</textarea>





                @error('note')

                <p class="text-sm text-red-500 mt-1">

                    {{ $message }}

                </p>

                @enderror



            </div>







            {{-- Button --}}

            <div class="flex justify-end gap-3 mt-8">



                <a href="{{ route('stock-ins.index') }}"

                   class="px-6 py-3 rounded-xl bg-slate-500 text-white hover:bg-slate-600 transition">


                    Batal


                </a>





                <button
                    type="submit"

                    class="px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">


                    <i class="bi bi-save"></i>

                    Update Stock In


                </button>



            </div>





        </form>


    </div>


</div>


@endsection