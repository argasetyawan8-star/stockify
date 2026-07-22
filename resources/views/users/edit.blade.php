@extends('layouts.app')


@section('content')


<div class="p-6">


    <div class="mb-6">

        <h1 class="text-2xl font-bold">
            Edit User
        </h1>

        <p class="text-gray-500">
            Perbarui data pengguna
        </p>

    </div>




    <div class="bg-white rounded-xl shadow p-6">


        <form action="{{ route('users.update',$user->id) }}"
              method="POST">


            @csrf

            @method('PUT')



            @include('users.partials.form')



        </form>


    </div>


</div>


@endsection@extends('layouts.app')


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

                    Edit User

                </span>



            </nav>






            <h1 class="text-3xl font-bold text-gray-800">

                Edit User

            </h1>




            <p class="text-gray-500 mt-1">

                Perbarui informasi pengguna dan hak akses Stockify.

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


                Form Edit User


            </h2>




            <p class="text-sm text-gray-500 mt-1">


                Ubah data user tanpa mengubah password jika tidak diperlukan.


            </p>



        </div>







        <div class="p-6">





            <form

                action="{{ route('users.update',$user->id) }}"

                method="POST">



                @csrf


                @method('PUT')





                @include('users.partials.form')




            </form>





        </div>




    </div>





</div>



@endsection