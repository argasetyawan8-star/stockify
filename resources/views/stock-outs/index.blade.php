@extends('layouts.app')

@section('title', 'Stock Out')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Stock Out
            </h1>

            <p class="text-slate-500 mt-1">
                Data Barang Keluar
            </p>

        </div>

        <a href="{{ route('stock-outs.create') }}"
            class="inline-flex items-center px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl transition">

            <i class="bi bi-plus-circle mr-2"></i>

            Tambah Stock Out

        </a>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="mb-5 p-4 rounded-lg bg-green-100 text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- Search --}}
    <div class="bg-white rounded-xl shadow mb-5">

        <div class="p-5">

            <form method="GET">

                <div class="flex gap-3">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama produk..."
                        class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500">

                    <button
                        class="px-5 bg-red-600 hover:bg-red-700 text-white rounded-lg">

                        <i class="bi bi-search"></i>

                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- Table --}}
    <div class="overflow-hidden bg-white rounded-xl shadow">

        <table class="w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="p-4 text-left">
                        No
                    </th>

                    <th class="p-4 text-left">
                        Tanggal
                    </th>

                    <th class="p-4 text-left">
                        Produk
                    </th>

                    <th class="p-4 text-left">
                        Qty
                    </th>

                    <th class="p-4 text-left">
                        Status
                    </th>

                    <th class="p-4 text-left">
                        Catatan
                    </th>

                    <th class="p-4 text-center">
                        Action
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($stockOuts as $stock)

                <tr class="border-t hover:bg-slate-50">

                    <td class="p-4">

                        {{ $stockOuts->firstItem() + $loop->index }}

                    </td>

                    <td class="p-4">

                        {{ \Carbon\Carbon::parse($stock->date)->format('d M Y') }}

                    </td>

                    <td class="p-4 font-medium">

                        {{ $stock->product?->name }}

                    </td>

                    <td class="p-4 font-semibold text-red-600">

                        -{{ $stock->qty }}

                    </td>

                    <td class="p-4">

                        @if($stock->status == 'pending')

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-sm font-medium">
                                Pending
                            </span>

                        @elseif($stock->status == 'approved')

                            <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-sm font-medium">
                                Approved
                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-sm font-medium">
                                Rejected
                            </span>

                        @endif

                    </td>

                    <td class="p-4">

                        {{ $stock->note ?? '-' }}

                    </td>

                    <td class="p-4">

                        <div class="flex justify-center gap-2">

                            @if($stock->status == 'pending')

                                <a href="{{ route('stock-outs.edit',$stock->id) }}"
                                    class="px-3 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white">

                                    <i class="bi bi-pencil"></i>

                                </a>

                                <form
                                    action="{{ route('stock-outs.destroy',$stock->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus data ini?')"
                                        class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            @else

                                <span class="text-gray-400 text-sm">

                                    Terkunci

                                </span>

                            @endif

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="p-6 text-center text-slate-500">

                        Belum ada data Stock Out.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div class="mt-5">

        {{ $stockOuts->withQueryString()->links() }}

    </div>

</div>

@endsection