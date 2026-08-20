@extends('layouts.app')
                    
@section('title', 'Pengaturan')

@section('content')

<div class="w-full">

    <div class="px-6 py-4">

        <div class="max-w-6xl mx-auto">


            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-8">


                <div class="flex items-center gap-4">


                    <div class="w-12 h-12 flex items-center justify-center bg-blue-100 rounded-xl">

                        <i class="bi bi-gear-fill text-blue-600 text-xl"></i>

                    </div>


                    <div>

                        <h1 class="text-2xl font-bold text-gray-800">
                            Pengaturan Aplikasi
                        </h1>

                        <p class="text-sm text-gray-500">
                            Kelola konfigurasi Stockify
                        </p>

                    </div>


                </div>




                <a href="{{ route('settings.edit',$setting->id) }}"
                   class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 flex items-center gap-2">


                    <i class="bi bi-pencil"></i>

                    Edit


                </a>


            </div>








            {{-- APPLICATION CARD --}}
            <div class="bg-white rounded-xl border shadow-sm p-6 mb-6">


                <div class="flex items-center gap-2 mb-6">


                    <i class="bi bi-window text-blue-600"></i>


                    <h2 class="font-semibold text-gray-800">
                        Informasi Aplikasi
                    </h2>


                </div>





                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


                    {{-- LOGO --}}

                    <div class="flex justify-center items-center">


                        @if($setting->logo)

                            <img
                            src="{{ asset('storage/'.$setting->logo) }}"
                            class="w-32 h-32 rounded-xl object-cover border">


                        @else

                            <div class="w-32 h-32 rounded-xl bg-blue-50 flex items-center justify-center">

                                <span class="text-3xl font-bold text-blue-600">

                                    {{ substr($setting->app_name,0,2) }}

                                </span>


                            </div>

                        @endif


                    </div>





                    {{-- DATA APP --}}
                    <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-5">


                        <div>

                            <p class="text-sm text-gray-500">
                                Nama Aplikasi
                            </p>


                            <p class="font-semibold text-gray-800">
                                {{ $setting->app_name ?? '-' }}
                            </p>


                        </div>





                        <div>

                            <p class="text-sm text-gray-500">
                                Currency
                            </p>


                            <p class="font-semibold text-gray-800">
                                {{ $setting->currency ?? 'IDR' }}
                            </p>


                        </div>





                        <div class="md:col-span-2">


                            <p class="text-sm text-gray-500 mb-2">
                                Deskripsi
                            </p>


                            <p class="text-gray-700 bg-gray-50 p-3 rounded-lg">

                                {{ $setting->description ?? '-' }}

                            </p>


                        </div>



                    </div>



                </div>



            </div>









            {{-- COMPANY CARD --}}
            <div class="bg-white rounded-xl border shadow-sm p-6 mb-6">


                <div class="flex items-center gap-2 mb-6">


                    <i class="bi bi-building text-blue-600"></i>


                    <h2 class="font-semibold text-gray-800">
                        Informasi Perusahaan
                    </h2>


                </div>






                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                    <div>
                        <p class="text-sm text-gray-500">
                            Nama Perusahaan
                        </p>

                        <p class="font-semibold">
                            {{ $setting->company_name ?? '-' }}
                        </p>

                    </div>



                    <div>
                        <p class="text-sm text-gray-500">
                            Email
                        </p>

                        <p class="font-semibold">
                            {{ $setting->email ?? '-' }}
                        </p>

                    </div>



                    <div>
                        <p class="text-sm text-gray-500">
                            Telepon
                        </p>

                        <p class="font-semibold">
                            {{ $setting->phone ?? '-' }}
                        </p>

                    </div>



                    <div>
                        <p class="text-sm text-gray-500">
                            Website
                        </p>

                        <p class="font-semibold">
                            {{ $setting->website ?? '-' }}
                        </p>

                    </div>




                    <div class="md:col-span-2">


                        <p class="text-sm text-gray-500">
                            Alamat
                        </p>


                        <p class="font-semibold">

                            {{ $setting->address ?? '-' }}

                        </p>


                    </div>


                </div>


            </div>









            {{-- SYSTEM CARD --}}
            <div class="bg-white rounded-xl border shadow-sm p-6">


                <div class="flex items-center gap-2 mb-6">


                    <i class="bi bi-cpu text-blue-600"></i>


                    <h2 class="font-semibold text-gray-800">
                        Konfigurasi Sistem
                    </h2>


                </div>




                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">



                    <div class="bg-gray-50 rounded-lg p-4 text-center">

                        <p class="text-sm text-gray-500">
                            Minimum Stock
                        </p>


                        <p class="text-xl font-bold">
                            {{ $setting->minimum_stock }}
                        </p>


                    </div>




                    <div class="bg-gray-50 rounded-lg p-4 text-center">

                        <p class="text-sm text-gray-500">
                            Pagination
                        </p>


                        <p class="text-xl font-bold">
                            {{ $setting->default_pagination }}
                        </p>


                    </div>




                    <div class="bg-gray-50 rounded-lg p-4 text-center">

                        <p class="text-sm text-gray-500">
                            Timezone
                        </p>


                        <p class="font-bold">
                            {{ $setting->timezone }}
                        </p>


                    </div>




                    <div class="bg-green-50 rounded-lg p-4 text-center">

                        <p class="text-sm text-gray-500">
                            Status
                        </p>


                        <p class="font-bold text-green-600">
                            Active
                        </p>


                    </div>



                </div>


            </div>



        </div>


    </div>


</div>


@endsection









