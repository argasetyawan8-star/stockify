@extends('example.layouts.default.dashboard')

@section('content')

<div class="max-w-5xl mx-auto p-6">

    <div class="bg-white rounded-lg shadow p-6">


        <div class="mb-6">

            <h2 class="text-xl font-semibold text-gray-800">
                Edit Transaksi Stok
            </h2>

            <p class="text-sm text-gray-500">
                Perbarui data transaksi stok.
            </p>

        </div>



        @include('stock-transactions._form')


    </div>

</div>

@endsection