@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')


<div class="w-full">

<div class="mt-14 px-6 py-6">


<div class="max-w-[1400px] mx-auto space-y-6">



{{-- ================= HEADER ================= --}}

<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">


    <div>


        <h1 class="text-3xl font-bold text-slate-800">

            Good Morning, 
            {{ Auth::user()->name }} 

        </h1>


        <p class="mt-2 text-slate-500">

            Berikut ringkasan aktivitas Stockify hari ini.

        </p>


    </div>



    <div class="bg-blue-50 px-5 py-3 rounded-xl border border-blue-100">


        <p class="text-sm text-blue-700">

            {{ now()->format('d F Y') }}

        </p>


        <p class="text-xs text-blue-500">

            Inventory Management System

        </p>


    </div>



</div>






{{-- ================= STATISTIC CARD ================= --}}


<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-6 gap-5">





{{-- TOTAL PRODUK --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition p-5">


<div class="flex items-center justify-between">


<div>

<p class="text-sm text-slate-500">

Total Produk

</p>


<h2 class="mt-2 text-3xl font-bold text-slate-800">

{{ $totalProducts }}

</h2>


</div>



<div class="p-3 rounded-xl bg-blue-100 text-blue-600">

<i class="bi bi-box-seam text-2xl"></i>

</div>



</div>


</div>






{{-- TOTAL STOCK --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition p-5">


<div class="flex items-center justify-between">


<div>

<p class="text-sm text-slate-500">

Total Stok

</p>


<h2 class="mt-2 text-3xl font-bold text-slate-800">

{{ $totalStock }}

</h2>


</div>



<div class="p-3 rounded-xl bg-purple-100 text-purple-600">

<i class="bi bi-boxes text-2xl"></i>

</div>



</div>


</div>







{{-- CATEGORY --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition p-5">


<div class="flex items-center justify-between">


<div>

<p class="text-sm text-slate-500">

Kategori

</p>


<h2 class="mt-2 text-3xl font-bold text-slate-800">

{{ $totalCategories }}

</h2>


</div>



<div class="p-3 rounded-xl bg-green-100 text-green-600">

<i class="bi bi-tags text-2xl"></i>

</div>



</div>


</div>







{{-- SUPPLIER --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition p-5">


<div class="flex items-center justify-between">


<div>

<p class="text-sm text-slate-500">

Supplier

</p>


<h2 class="mt-2 text-3xl font-bold text-slate-800">

{{ $totalSuppliers }}

</h2>


</div>



<div class="p-3 rounded-xl bg-yellow-100 text-yellow-600">

<i class="bi bi-truck text-2xl"></i>

</div>



</div>


</div>







{{-- STOCK IN --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition p-5">


<div class="flex items-center justify-between">


<div>

<p class="text-sm text-slate-500">

Barang Masuk

</p>


<h2 class="mt-2 text-3xl font-bold text-green-600">

{{ $stockIn }}

</h2>


</div>



<div class="p-3 rounded-xl bg-green-100 text-green-600">

<i class="bi bi-box-arrow-in-down text-2xl"></i>

</div>



</div>


</div>







{{-- STOCK OUT --}}

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-md transition p-5">


<div class="flex items-center justify-between">


<div>

<p class="text-sm text-slate-500">

Barang Keluar

</p>


<h2 class="mt-2 text-3xl font-bold text-red-600">

{{ $stockOut }}

</h2>


</div>



<div class="p-3 rounded-xl bg-red-100 text-red-600">

<i class="bi bi-box-arrow-up text-2xl"></i>

</div>



</div>


</div>




</div>

{{-- ============================= --}}
{{-- CHART SECTION --}}
{{-- ============================= --}}


<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">



    {{-- STOCK IN VS STOCK OUT --}}

    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">


        <div class="flex items-center justify-between mb-6">


            <div>


                <h3 class="text-lg font-bold text-slate-800">

                    Stock In vs Stock Out

                </h3>


                <p class="text-sm text-slate-500 mt-1">

                    Perbandingan transaksi barang

                </p>


            </div>



            <div class="p-3 rounded-xl bg-blue-100 text-blue-600">


                <i class="bi bi-bar-chart-fill text-xl"></i>


            </div>



        </div>



        <canvas id="stockChart"
            height="140">
        </canvas>


    </div>








    {{-- MONTHLY TREND --}}


    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">


        <div class="flex items-center justify-between mb-6">


            <div>


                <h3 class="text-lg font-bold text-slate-800">

                    Monthly Transaction Trend

                </h3>


                <p class="text-sm text-slate-500 mt-1">

                    Perkembangan transaksi tahun berjalan

                </p>


            </div>




            <div class="p-3 rounded-xl bg-green-100 text-green-600">


                <i class="bi bi-graph-up-arrow text-xl"></i>


            </div>



        </div>




        <canvas id="trendChart"
            height="140">
        </canvas>



    </div>




</div>









{{-- ============================= --}}
{{-- LOW STOCK + RECENT TRANSACTION --}}
{{-- ============================= --}}



<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">






{{-- LOW STOCK --}}



<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">


    <div class="flex items-center justify-between mb-6">


        <div>


            <h3 class="text-lg font-bold text-slate-800">

                Stok Menipis

            </h3>



            <p class="text-sm text-slate-500">

                Produk yang perlu diperhatikan

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



                <tr class="border-b hover:bg-slate-50">


                    <td class="py-3 font-medium text-slate-700">


                        {{ $product->name }}


                    </td>




                    <td class="text-center">


                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 font-semibold">


                            {{ $product->stock }}


                        </span>


                    </td>





                    <td class="text-center text-slate-600">


                        {{ $product->minimum_stock }}


                    </td>


                </tr>



            @empty



                <tr>


                    <td colspan="3"
                        class="text-center py-6 text-slate-500">


                        Semua stok aman 👍


                    </td>


                </tr>



            @endforelse



            </tbody>



        </table>



    </div>



</div>









{{-- RECENT TRANSACTION --}}



<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">



    <div class="flex items-center justify-between mb-6">


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



            @forelse($recentTransactions as $transaction)



                <tr class="border-b hover:bg-slate-50">


                    <td class="py-3">


                        {{ $transaction->date }}


                    </td>




                    <td>


                        {{ $transaction->product->name ?? '-' }}


                    </td>





                    <td>


                        @if($transaction->type == 'IN')


                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">


                                IN


                            </span>



                        @else


                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">


                                OUT


                            </span>



                        @endif



                    </td>





                    <td class="text-center font-semibold">


                        {{ $transaction->qty }}


                    </td>



                </tr>



            @empty


                <tr>


                    <td colspan="4"
                        class="text-center py-6 text-slate-500">


                        Belum ada transaksi


                    </td>


                </tr>



            @endforelse



            </tbody>


        </table>


    </div>



</div>





</div>

{{-- ============================= --}}
{{-- APPROVAL + ACTIVITY --}}
{{-- ============================= --}}


<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">





{{-- PENDING APPROVAL --}}


<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">


    <div class="flex items-center justify-between mb-6">


        <div>


            <h3 class="text-lg font-bold text-slate-800">

                Pending Approval

            </h3>


            <p class="text-sm text-slate-500">

                Transaksi yang membutuhkan pemeriksaan

            </p>


        </div>



        <div class="p-3 rounded-xl bg-orange-100 text-orange-600">


            <i class="bi bi-patch-check-fill text-xl"></i>


        </div>



    </div>





    <div class="flex items-center justify-between bg-orange-50 rounded-xl p-5">


        <div>


            <p class="text-sm text-orange-700">

                Menunggu Konfirmasi

            </p>



            <h2 class="text-4xl font-bold text-orange-600 mt-2">

                {{ $pendingApproval }}

            </h2>


        </div>



        <i class="bi bi-hourglass-split text-5xl text-orange-400"></i>



    </div>




    <div class="mt-5 grid grid-cols-2 gap-4">


        <div class="rounded-xl bg-slate-50 p-4">


            <p class="text-xs text-slate-500">

                Stock In Pending

            </p>


            <p class="text-2xl font-bold text-slate-800 mt-1">

                {{ $pendingStockIn }}

            </p>


        </div>




        <div class="rounded-xl bg-slate-50 p-4">


            <p class="text-xs text-slate-500">

                Stock Out Pending

            </p>


            <p class="text-2xl font-bold text-slate-800 mt-1">

                {{ $pendingStockOut }}

            </p>


        </div>



    </div>



</div>







{{-- ACTIVITY LOG --}}



<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">


    <div class="flex items-center justify-between mb-6">


        <div>


            <h3 class="text-lg font-bold text-slate-800">

                Aktivitas Terbaru

            </h3>



            <p class="text-sm text-slate-500">

                Riwayat aktivitas pengguna

            </p>


        </div>




        <div class="p-3 rounded-xl bg-purple-100 text-purple-600">


            <i class="bi bi-clock-history text-xl"></i>


        </div>



    </div>






    <div class="space-y-4">


    @forelse($recentActivities as $activity)



        <div class="flex items-start gap-4">


            <div
                class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 text-blue-600">


                <i class="bi bi-person-check"></i>


            </div>




            <div>


                <p class="text-sm font-medium text-slate-700">


                    {{ $activity->description ?? 'Melakukan aktivitas sistem' }}


                </p>



                <p class="text-xs text-slate-400 mt-1">


                   {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }}


                </p>



            </div>



        </div>




    @empty



        <div class="text-center py-6 text-slate-500">


            Belum ada aktivitas


        </div>



    @endforelse



    </div>



</div>





</div>







</div> {{-- max width --}}

</div> {{-- padding --}}

</div> {{-- wrapper --}}





@endsection







@push('scripts')


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




<script>


/*
|--------------------------------------------------------------------------
| STOCK IN VS STOCK OUT
|--------------------------------------------------------------------------
*/


const stockChart =
document.getElementById('stockChart');



if(stockChart)
{


new Chart(stockChart,{


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


            borderRadius:8,


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



}









/*
|--------------------------------------------------------------------------
| MONTHLY TREND
|--------------------------------------------------------------------------
*/


const trendChart =
document.getElementById('trendChart');



if(trendChart)
{


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



}



</script>



@endpush