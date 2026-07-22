@extends('layouts.app')

@section('content')

<div class="p-4 bg-white border-b border-gray-200">

    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                Data Produk
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola seluruh data produk Stockify.
            </p>
        </div>


        {{-- Tambah Produk hanya yang punya manage products --}}
       @can('manage products')

<a href="{{ route('products.create') }}"
class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">

    <i class="bi bi-plus-circle mr-2"></i>

    Tambah Produk

</a>

@endcan


    </div>


    @if(session('success'))

        <div class="p-4 mb-5 text-green-800 bg-green-100 rounded-lg">

            {{ session('success') }}

        </div>

    @endif



    <div class="flex justify-between mb-4">

        <input
            type="text"
            placeholder="Cari produk..."
            class="w-80 rounded-lg border-gray-300">

    </div>

</div>



<div class="relative overflow-x-auto bg-white shadow-md rounded-b-lg">


<table class="w-full text-sm text-left text-gray-500">


<thead class="text-xs text-gray-700 uppercase bg-gray-100">


<tr>

<th class="px-6 py-4">
No
</th>


<th class="px-6 py-4">
Foto
</th>


<th class="px-6 py-4">
SKU
</th>


<th class="px-6 py-4">
Nama Produk
</th>


<th class="px-6 py-4">
Kategori
</th>


<th class="px-6 py-4">
Supplier
</th>


<th class="px-6 py-4">
Harga Jual
</th>


<th class="px-6 py-4">
Stok
</th>


<th class="px-6 py-4">
Min. Stok
</th>


@can('manage products')
<th class="px-6 py-4 text-center">
    Aksi
</th>
@endcan


</tr>


</thead>



<tbody>


@forelse($products as $product)


<tr class="bg-white border-b hover:bg-gray-50">


<td class="px-6 py-4">

{{ $loop->iteration }}

</td>



<td class="px-6 py-4">


@if($product->image)

<img
src="{{ asset('storage/'.$product->image) }}"
class="w-14 h-14 rounded-lg object-cover">


@else


<div class="w-14 h-14 bg-gray-200 rounded-lg flex items-center justify-center">

No Image

</div>


@endif


</td>



<td class="px-6 py-4">

{{ $product->sku }}

</td>



<td class="px-6 py-4 font-medium text-gray-900">

{{ $product->name }}

</td>



<td class="px-6 py-4">

{{ $product->category->name }}

</td>



<td class="px-6 py-4">

{{ $product->supplier->name }}

</td>



<td class="px-6 py-4">

Rp {{ number_format($product->selling_price,0,',','.') }}

</td>



<td class="px-6 py-4">


@if($product->stock <= $product->minimum_stock)

<span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">

{{ $product->stock }}

</span>


@else


<span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">

{{ $product->stock }}

</span>


@endif


</td>



<td class="px-6 py-4">

{{ $product->minimum_stock }}

</td>



@can('manage products')

<td class="px-6 py-4">

<div class="flex justify-center gap-2">


<a
href="{{ route('products.edit',$product->id) }}"
class="px-3 py-2 text-white bg-yellow-500 rounded-lg hover:bg-yellow-600">

<i class="bi bi-pencil"></i>
Edit

</a>


<form
action="{{ route('products.destroy',$product->id) }}"
method="POST">

@csrf
@method('DELETE')


<button
onclick="return confirm('Yakin ingin menghapus produk ini?')"
class="px-3 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700">


<i class="bi bi-trash"></i>
Hapus


</button>


</form>


</div>

</td>

@endcan


</tr>


@empty


<tr>

<td colspan="10"
class="px-6 py-10 text-center text-gray-500">

Belum ada data produk.

</td>


</tr>


@endforelse


</tbody>


</table>


</div>



<div class="mt-5">

{{ $products->links() }}

</div>


@endsection