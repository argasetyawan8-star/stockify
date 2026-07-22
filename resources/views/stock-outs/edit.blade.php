@extends('layouts.app')

@section('title','Edit Stock Out')

@section('content')

<div class="p-6">


    {{-- Header --}}
    <div class="mb-6">

        <h1 class="text-3xl font-bold text-slate-800">
            Edit Stock Out
        </h1>

        <p class="text-slate-500 mt-1">
            Perbarui data barang keluar gudang.
        </p>

    </div>




    {{-- Error Alert --}}
    @if(session('error'))

        <div class="mb-5 rounded-lg bg-red-100 border border-red-300 px-4 py-3 text-red-700">

            {{ session('error') }}

        </div>

    @endif






    <div class="bg-white rounded-2xl shadow-md border border-slate-200">


        <form
            action="{{ route('stock-outs.update',$stockOut->id) }}"
            method="POST"
            class="p-8">


            @csrf
            @method('PUT')





            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">





                {{-- Product --}}
                <div>


                    <label class="block mb-2 font-semibold text-slate-700">

                        Produk

                        <span class="text-red-500">*</span>

                    </label>



                    <select
                        name="product_id"
                        class="w-full rounded-xl border-slate-300 focus:border-red-500 focus:ring-red-500">



                        <option value="">
                            -- Pilih Produk --
                        </option>



                        @foreach($products as $product)


                            <option
                                value="{{ $product->id }}"
                                {{ old('product_id',$stockOut->product_id) == $product->id ? 'selected' : '' }}>


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

                        Jumlah Keluar

                        <span class="text-red-500">*</span>

                    </label>



                    <input
                        type="number"
                        name="qty"
                        min="1"
                        value="{{ old('qty',$stockOut->qty) }}"
                        placeholder="Jumlah barang"
                        class="w-full rounded-xl border-slate-300 focus:border-red-500 focus:ring-red-500">



                    @error('qty')

                        <p class="text-sm text-red-500 mt-1">

                            {{ $message }}

                        </p>

                    @enderror



                </div>








                {{-- Date --}}
                <div>


                    <label class="block mb-2 font-semibold text-slate-700">

                        Tanggal Keluar

                        <span class="text-red-500">*</span>

                    </label>



                    <input
                        type="date"
                        name="date"
                        value="{{ old('date',\Carbon\Carbon::parse($stockOut->date)->format('Y-m-d')) }}"
                        class="w-full rounded-xl border-slate-300 focus:border-red-500 focus:ring-red-500">



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
                        value="{{ old('reference',$stockOut->reference) }}"
                        placeholder="Nomor referensi"
                        class="w-full rounded-xl border-slate-300 focus:border-red-500 focus:ring-red-500">



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
                    class="w-full rounded-xl border-slate-300 focus:border-red-500 focus:ring-red-500">{{ old('note',$stockOut->note) }}</textarea>




                @error('note')

                    <p class="text-sm text-red-500 mt-1">

                        {{ $message }}

                    </p>

                @enderror



            </div>








            {{-- Button --}}
            <div class="flex justify-end gap-3 mt-8">


                <a href="{{ route('stock-outs.index') }}"
                   class="px-6 py-3 rounded-xl bg-slate-500 text-white hover:bg-slate-600 transition">


                    Kembali


                </a>




                <button
                    type="submit"
                    class="px-6 py-3 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">


                    Update Stock Out


                </button>



            </div>




        </form>


    </div>


</div>


@endsection