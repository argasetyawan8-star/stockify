@extends('layouts.app')

@section('title', 'Laporan')

@section('content')

@php
$reportType = request('report', 'inventory');

$reportTitle = match ($reportType) {
    'inventory' => ' Rekap Persediaan',
    'stock_in' => '📥 Laporan Stock In',
    'stock_out' => '📤 Laporan Stock Out',
    'stock_opname' => '📋 Laporan Stock Opname',
    'low_stock' => '⚠️ Laporan Low Stock',
    default => ' Rekap Persediaan',
};
@endphp


<div class="space-y-6">


{{-- HEADER --}}
<div class="flex justify-between items-center">

    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            {{ $reportTitle }}
        </h1>

        <p class="text-slate-500 mt-2">
            Monitoring data persediaan Stockify.
        </p>
    </div>


    <div class="flex gap-3">

        <a href="{{ route('reports.pdf', request()->query()) }}"
           class="px-5 py-3 bg-red-600 text-white rounded-xl">

            <i class="bi bi-file-earmark-pdf"></i>
            PDF

        </a>


        <a href="{{ route('reports.excel', request()->query()) }}"
           class="px-5 py-3 bg-green-600 text-white rounded-xl">

            <i class="bi bi-file-earmark-excel"></i>
            Excel

        </a>

    </div>

</div>




{{-- FILTER --}}
<div class="bg-white rounded-2xl border p-6">


<form method="GET"
      action="{{ route('reports.index') }}">


<div class="grid md:grid-cols-4 gap-5">


<div>

<label class="block mb-2">
Jenis Report
</label>


<select name="report"
class="w-full rounded-xl border">


<option value="inventory"
@selected($reportType=='inventory')>
Inventory
</option>


<option value="stock_in"
@selected($reportType=='stock_in')>
Stock In
</option>


<option value="stock_out"
@selected($reportType=='stock_out')>
Stock Out
</option>


<option value="stock_opname"
@selected($reportType=='stock_opname')>
Stock Opname
</option>


<option value="low_stock"
@selected($reportType=='low_stock')>
Low Stock
</option>


</select>


</div>



<div>

<label class="block mb-2">
Supplier
</label>


<select name="supplier_id"
class="w-full rounded-xl border">


<option value="">
Semua Supplier
</option>


@foreach($suppliers as $supplier)

<option value="{{ $supplier->id }}"
@selected(request('supplier_id')==$supplier->id)>

{{ $supplier->name }}

</option>

@endforeach


</select>


</div>



<div>

<label class="block mb-2">
Produk
</label>


<select name="product_id"
class="w-full rounded-xl border">


<option value="">
Semua Produk
</option>


@foreach($products as $product)


<option value="{{ $product->id }}"
@selected(request('product_id')==$product->id)>

{{ $product->name }}

</option>


@endforeach


</select>

</div>




<div>

<label class="block mb-2">
Search
</label>


<input type="text"
name="search"
value="{{ request('search') }}"
class="w-full rounded-xl border"
placeholder="Nama / SKU">


</div>



</div>


<div class="flex justify-end mt-5 gap-3">


<a href="{{ route('reports.index') }}"
class="px-5 py-3 border rounded-xl">

Reset

</a>


<button
class="px-5 py-3 bg-blue-600 text-white rounded-xl">



Filter

</button>


</div>


</form>


</div>





{{-- TABLE --}}
<div class="bg-white rounded-2xl border overflow-hidden">


<div class="p-5 border-b">

<h2 class="font-bold text-xl">
Data Laporan
</h2>

</div>



<div class="overflow-x-auto">


<table class="min-w-full">


<thead class="bg-slate-100">


<tr>


<th class="px-6 py-4">
No
</th>


@if($reportType=='inventory')

<th class="px-6 py-4">
SKU
</th>

<th class="px-6 py-4">
Produk
</th>

<th class="px-6 py-4">
Supplier
</th>

<th class="px-6 py-4">
Stock
</th>

@endif



@if(in_array($reportType,['stock_in','stock_out']))

<th class="px-6 py-4">
Tanggal
</th>

<th class="px-6 py-4">
Produk
</th>

<th class="px-6 py-4">
Qty
</th>

<th class="px-6 py-4">
Status
</th>

@endif



@if($reportType=='stock_opname')

<th class="px-6 py-4">
Produk
</th>

<th class="px-6 py-4">
System
</th>

<th class="px-6 py-4">
Physical
</th>

<th class="px-6 py-4">
Selisih
</th>

@endif



@if($reportType=='low_stock')

<th class="px-6 py-4">
SKU
</th>

<th class="px-6 py-4">
Produk
</th>

<th class="px-6 py-4">
Stock
</th>

<th class="px-6 py-4">
Minimum
</th>

@endif


</tr>


</thead>




<tbody class="divide-y">



@forelse($reports as $report)


<tr>


<td class="px-6 py-4">

{{ $loop->iteration }}

</td>



@if($reportType=='inventory')


<td class="px-6 py-4">
{{ $report->sku }}
</td>


<td class="px-6 py-4 font-semibold">
{{ $report->name }}
</td>


<td class="px-6 py-4">
{{ $report->supplier->name ?? '-' }}
</td>


<td class="px-6 py-4 text-center">
{{ number_format($report->stock) }}
</td>


@endif




@if($reportType=='stock_in')


<td class="px-6 py-4">
{{ $report->date }}
</td>


<td class="px-6 py-4">
{{ $report->product->name ?? '-' }}
</td>


<td class="px-6 py-4 text-green-600 font-bold">
+{{ $report->qty }}
</td>


<td class="px-6 py-4">
{{ ucfirst($report->status) }}
</td>


@endif





@if($reportType=='stock_out')


<td class="px-6 py-4">
{{ $report->date }}
</td>


<td class="px-6 py-4">
{{ $report->product->name ?? '-' }}
</td>


<td class="px-6 py-4 text-red-600 font-bold">
-{{ $report->qty }}
</td>


<td class="px-6 py-4">
{{ ucfirst($report->status) }}
</td>


@endif





@if($reportType=='stock_opname')


<td class="px-6 py-4">
{{ $report->product->name ?? '-' }}
</td>


<td class="px-6 py-4">
{{ $report->system_stock }}
</td>


<td class="px-6 py-4">
{{ $report->physical_stock }}
</td>


<td class="px-6 py-4">
{{ $report->difference }}
</td>


@endif





@if($reportType=='low_stock')


<td class="px-6 py-4">
{{ $report->sku }}
</td>


<td class="px-6 py-4">
{{ $report->name }}
</td>


<td class="px-6 py-4">
{{ $report->stock }}
</td>


<td class="px-6 py-4">
{{ $report->minimum_stock }}
</td>


@endif



</tr>



@empty


<tr>

<td colspan="10"
class="text-center py-10">

Tidak ada data.

</td>

</tr>


@endforelse



</tbody>


</table>


</div>




@if($reports instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)

<div class="p-5 border-t">

{{ $reports->withQueryString()->links() }}

</div>

@endif



</div>


</div>


@endsection