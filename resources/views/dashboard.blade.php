@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="space-y-8">




    {{-- HEADER --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Dashboard
        </h1>

        <p class="text-slate-500">
            Selamat datang kembali, {{ Auth::user()->name }}
        </p>
    </div>



    {{-- STATISTIC CARD --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5">


        {{-- PRODUCTS --}}
        <div class="bg-white rounded-xl shadow p-5 border">

            <div class="flex justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Total Produk
                    </p>

                    <h2 class="text-3xl font-bold text-slate-800">
                        {{ $totalProducts }}
                    </h2>

                </div>

                <div class="bg-blue-100 text-blue-600 p-3 rounded-xl">

                    <i class="bi bi-box-seam text-2xl"></i>

                </div>

            </div>

        </div>



        {{-- CATEGORY --}}
        <div class="bg-white rounded-xl shadow p-5 border">

            <div class="flex justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Kategori
                    </p>

                    <h2 class="text-3xl font-bold">
                        {{ $totalCategories }}
                    </h2>

                </div>


                <div class="bg-green-100 text-green-600 p-3 rounded-xl">

                    <i class="bi bi-tags text-2xl"></i>

                </div>

            </div>

        </div>




        {{-- SUPPLIER --}}
        <div class="bg-white rounded-xl shadow p-5 border">

            <div class="flex justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Supplier
                    </p>

                    <h2 class="text-3xl font-bold">
                        {{ $totalSuppliers }}
                    </h2>

                </div>


                <div class="bg-yellow-100 text-yellow-600 p-3 rounded-xl">

                    <i class="bi bi-truck text-2xl"></i>

                </div>


            </div>

        </div>




        {{-- STOCK IN --}}
        <div class="bg-white rounded-xl shadow p-5 border">

            <div class="flex justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Barang Masuk
                    </p>

                    <h2 class="text-3xl font-bold text-green-600">
                        {{ $stockIn }}
                    </h2>

                </div>


                <div class="bg-green-100 text-green-600 p-3 rounded-xl">

                    <i class="bi bi-box-arrow-in-down text-2xl"></i>

                </div>


            </div>

        </div>




        {{-- STOCK OUT --}}
        <div class="bg-white rounded-xl shadow p-5 border">

            <div class="flex justify-between">

                <div>

                    <p class="text-sm text-slate-500">
                        Barang Keluar
                    </p>

                    <h2 class="text-3xl font-bold text-red-600">
                        {{ $stockOut }}
                    </h2>

                </div>


                <div class="bg-red-100 text-red-600 p-3 rounded-xl">

                    <i class="bi bi-box-arrow-up text-2xl"></i>

                </div>


            </div>

        </div>


    </div>





    {{-- ============================= --}}
{{-- CHART SECTION --}}
{{-- ============================= --}}


<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-6">


    {{-- STOCK IN VS STOCK OUT --}}
    <div class="bg-white rounded-2xl shadow p-6">


        <div class="flex items-center justify-between mb-5">

            <div>

                <h3 class="text-lg font-bold text-slate-800">

                    Stock In vs Stock Out

                </h3>


                <p class="text-sm text-slate-500">

                    Perbandingan transaksi barang

                </p>

            </div>


            <div class="p-3 rounded-xl bg-blue-100 text-blue-600">

                <i class="bi bi-bar-chart-fill text-xl"></i>

            </div>

        </div>



        <canvas id="stockChart"
            height="150">
        </canvas>


    </div>





    {{-- TREND BULANAN --}}
    <div class="bg-white rounded-2xl shadow p-6">


        <div class="flex items-center justify-between mb-5">

            <div>

                <h3 class="text-lg font-bold text-slate-800">

                    Monthly Transaction Trend

                </h3>


                <p class="text-sm text-slate-500">

                    Perkembangan transaksi selama tahun berjalan

                </p>

            </div>


            <div class="p-3 rounded-xl bg-green-100 text-green-600">

                <i class="bi bi-graph-up-arrow text-xl"></i>

            </div>


        </div>



        <canvas id="trendChart"
            height="150">
        </canvas>


    </div>



</div>



        {{-- ============================= --}}
{{-- LOW STOCK + RECENT TRANSACTION --}}
{{-- ============================= --}}

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">


    {{-- LOW STOCK --}}
    <div class="bg-white rounded-2xl shadow p-6">

        <div class="flex items-center justify-between mb-5">

            <div>
                <h3 class="text-lg font-bold text-slate-800">
                    Stok Menipis
                </h3>

                <p class="text-sm text-slate-500">
                    Produk yang perlu segera diperhatikan
                </p>
            </div>


            <div class="p-3 rounded-xl bg-red-100 text-red-600">

                <i class="bi bi-exclamation-triangle text-xl"></i>

            </div>

        </div>



        <div class="overflow-x-auto">


            <table class="w-full text-sm">


                <thead>

                    <tr class="border-b text-slate-500">

                        <th class="text-left py-3">
                            Produk
                        </th>


                        <th>
                            Stok
                        </th>


                        <th>
                            Minimum
                        </th>

                    </tr>

                </thead>



                <tbody>


                @forelse($lowStocks as $product)


                    <tr class="border-b">


                        <td class="py-3 font-medium">

                            {{ $product->name }}

                        </td>


                        <td class="text-center text-red-600 font-bold">

                            {{ $product->stock }}

                        </td>


                        <td class="text-center">

                            {{ $product->minimum_stock }}

                        </td>


                    </tr>


                @empty


                    <tr>

                        <td colspan="3"
                            class="text-center py-5 text-slate-500">

                            Semua stok aman 👍

                        </td>

                    </tr>


                @endforelse


                </tbody>


            </table>


        </div>


    </div>





    {{-- RECENT TRANSACTION --}}

    <div class="bg-white rounded-2xl shadow p-6">


        <div class="flex items-center justify-between mb-5">


            <div>

                <h3 class="text-lg font-bold text-slate-800">

                    Transaksi Terbaru

                </h3>


                <p class="text-sm text-slate-500">

                    Aktivitas transaksi terakhir

                </p>


            </div>


            <div class="p-3 rounded-xl bg-blue-100 text-blue-600">

                <i class="bi bi-clock-history text-xl"></i>

            </div>


        </div>




        <div class="overflow-x-auto">


            <table class="w-full text-sm">


                <thead>


                    <tr class="border-b text-slate-500">


                        <th class="text-left py-3">
                            Tanggal
                        </th>


                        <th>
                            Produk
                        </th>


                        <th>
                            Tipe
                        </th>


                        <th>
                            Qty
                        </th>


                    </tr>


                </thead>




                <tbody>


                @foreach($recentTransactions as $transaction)


                    <tr class="border-b">


                        <td class="py-3">

                            {{ $transaction->date }}

                        </td>


                        <td>

                            {{ $transaction->product->name ?? '-' }}

                        </td>


                        <td>


                            @if($transaction->type == 'IN')


                                <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">

                                    IN

                                </span>


                            @else


                                <span class="px-3 py-1 rounded-full bg-red-100 text-red-700">

                                    OUT

                                </span>


                            @endif


                        </td>



                        <td class="text-center">

                            {{ $transaction->qty }}

                        </td>



                    </tr>


                @endforeach



                </tbody>


            </table>


        </div>



    </div>



</div>



@endsection





@push('scripts')


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>


/*
|--------------------------------------------------------------------------
| Stock In VS Stock Out Chart
|--------------------------------------------------------------------------
*/


const stockChart = document
    .getElementById('stockChart');


new Chart(stockChart, {


    type:'bar',


    data:{


        labels:[

            'Stock In',

            'Stock Out'

        ],


        datasets:[{


            label:'Jumlah Barang',


            data:[

                {{ $stockIn }},

                {{ $stockOut }}

            ],


            borderWidth:1,


            borderRadius:8


        }]


    },


    options:{


        responsive:true,


        plugins:{


            legend:{


                display:false


            }


        }


    }


});






/*
|--------------------------------------------------------------------------
| Monthly Trend Chart
|--------------------------------------------------------------------------
*/


const trendChart = document
    .getElementById('trendChart');



new Chart(trendChart,{


    type:'line',


    data:{


        labels:@json($months),



        datasets:[


            {


                label:'Stock In',


                data:@json($monthlyStockIn),


                tension:.4,


                fill:false


            },



            {


                label:'Stock Out',


                data:@json($monthlyStockOut),


                tension:.4,


                fill:false


            }



        ]


    },


    options:{


        responsive:true,


        plugins:{


            legend:{


                position:'bottom'


            }


        }


    }


});



</script>




@endpush