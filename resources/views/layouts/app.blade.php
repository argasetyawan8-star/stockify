<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/images.jpeg') }}">

    <title>

        @hasSection('title')

            @yield('title') | Stockify

        @else

            Stockify Inventory System

        @endif

    </title>


    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">

    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet" />


    {{-- Bootstrap Icons --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    {{-- Vite --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])


    @stack('styles')


</head>


<body class="bg-slate-100 font-sans antialiased">


<div class="min-h-screen overflow-x-hidden">


    {{-- ================= SIDEBAR ================= --}}

    @include('layouts.partials.sidebar')





    {{-- ================= MAIN AREA ================= --}}

    <div class="lg:ml-64 min-h-screen flex flex-col">





        {{-- ================= NAVBAR ================= --}}

        @include('layouts.partials.navbar')







        {{-- ================= CONTENT ================= --}}

        <main class="flex-1 p-6 overflow-x-hidden">



            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div
                    class="mb-6 flex items-center gap-3 rounded-xl
                    border border-green-200 bg-green-50
                    px-5 py-4 text-green-700">


                    <i class="bi bi-check-circle-fill text-xl"></i>


                    <span>

                        {{ session('success') }}

                    </span>


                </div>

            @endif







            {{-- ERROR MESSAGE --}}

            @if(session('error'))

                <div
                    class="mb-6 flex items-center gap-3 rounded-xl
                    border border-red-200 bg-red-50
                    px-5 py-4 text-red-700">


                    <i class="bi bi-x-circle-fill text-xl"></i>


                    <span>

                        {{ session('error') }}

                    </span>


                </div>

            @endif







            {{-- VALIDATION ERROR --}}

            @if($errors->any())


                <div
                    class="mb-6 rounded-xl
                    border border-red-200 bg-red-50 p-5">



                    <div
                        class="flex items-center gap-2
                        text-red-700 font-semibold mb-3">


                        <i class="bi bi-exclamation-triangle-fill"></i>


                        Terjadi kesalahan


                    </div>





                    <ul
                        class="list-disc list-inside
                        text-sm text-red-600 space-y-1">


                        @foreach($errors->all() as $error)


                            <li>

                                {{ $error }}

                            </li>


                        @endforeach


                    </ul>


                </div>


            @endif







            {{-- PAGE CONTENT --}}

            @yield('content')



        </main>








        {{-- ================= FOOTER ================= --}}

        <div class="mt-auto">


            @include('layouts.partials.footer')


        </div>




    </div>



</div>





@stack('scripts')


</body>

</html>