@extends('layouts.app')


@section('content')


<div class="p-6">


    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">


        <div>


            <nav class="flex mb-2 text-sm text-gray-500">

                <a href="{{ route('dashboard') }}"
                   class="hover:text-blue-600">

                    Dashboard

                </a>


                <span class="mx-2">
                    /
                </span>


                <a href="{{ route('users.index') }}"
                   class="hover:text-blue-600">

                    Users

                </a>


                <span class="mx-2">
                    /
                </span>


                <span class="font-semibold text-gray-700">

                    Tambah User

                </span>


            </nav>




            <h1 class="text-3xl font-bold text-gray-800">

                Tambah User

            </h1>



            <p class="text-gray-500 mt-1">

                Tambahkan pengguna baru ke sistem Stockify.

            </p>


        </div>





        <a href="{{ route('users.index') }}"

           class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">


            <i class="bi bi-arrow-left mr-2"></i>


            Kembali


        </a>


    </div>





    {{-- Form Card --}}
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm">



        <div class="px-6 py-4 border-b border-gray-200">


            <h2 class="text-lg font-semibold text-gray-800">

                Form Tambah User

            </h2>


            <p class="text-sm text-gray-500 mt-1">

                Isi data pengguna dan tentukan hak aksesnya.

            </p>


        </div>





        <div class="p-6">


            <form

                action="{{ route('users.store') }}"

                method="POST">


                @csrf



                @include('users.partials.form')



            </form>


        </div>


    </div>



</div>



@endsection