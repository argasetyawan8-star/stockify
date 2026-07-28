@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')

<div class="p-4 sm:ml-64">

    <div class="p-4 mt-14">


        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">


            <div>

                <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">

                    <i class="bi bi-gear-fill text-blue-600"></i>

                    Pengaturan Aplikasi

                </h1>


                <p class="text-sm text-gray-500 mt-1">

                    Kelola informasi aplikasi dan konfigurasi sistem Stockify.

                </p>


            </div>


        </div>





        {{-- Alert Success --}}
        @if(session('success'))

            <div
                class="flex items-center p-4 mb-6 text-sm text-green-800 rounded-lg bg-green-100"
                role="alert">

                <i class="bi bi-check-circle-fill mr-2"></i>

                {{ session('success') }}

            </div>

        @endif






        {{-- Form --}}
        <form
            action="{{ route('settings.update', $setting->id) }}"
            method="POST"
            enctype="multipart/form-data">


            @csrf

            @method('PUT')



            @include('settings.partials.form')





            {{-- Button --}}
            <div class="flex justify-end gap-3 mt-6">


                <a
                    href="{{ route('dashboard') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">

                    <i class="bi bi-arrow-left mr-1"></i>

                    Kembali

                </a>





                <button
                    type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">


                    <i class="bi bi-save mr-1"></i>

                    Simpan Perubahan


                </button>



            </div>



        </form>



    </div>


</div>


@endsection