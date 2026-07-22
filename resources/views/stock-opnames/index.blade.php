@extends('layouts.app')

@section('title', 'Stock Opname')

@section('content')

<div class="flex items-center justify-between mb-6">

    <div>

        <h1 class="text-3xl font-bold text-slate-800">
            Stock Opname
        </h1>

        <p class="text-slate-500 mt-1">
            Kelola data stock opname produk.
        </p>

    </div>

    <a href="{{ route('stock-opnames.create') }}"
        class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">

        <i class="bi bi-plus-circle"></i>

        Tambah Stock Opname

    </a>

</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">No</th>

                    <th class="px-6 py-4 text-left">Produk</th>

                    <th class="px-6 py-4 text-center">Stok Sistem</th>

                    <th class="px-6 py-4 text-center">Stok Fisik</th>

                    <th class="px-6 py-4 text-center">Selisih</th>

                    <th class="px-6 py-4 text-left">Petugas</th>

                    <th class="px-6 py-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse ($stockOpnames as $item)

                    <tr class="border-t hover:bg-slate-50">

                        <td class="px-6 py-4">
                            {{ $loop->iteration + ($stockOpnames->firstItem() - 1) }}
                        </td>

                        <td class="px-6 py-4 font-semibold">
                            {{ $item->product->name }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $item->system_stock }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            {{ $item->physical_stock }}
                        </td>

                        <td class="px-6 py-4 text-center">

                            @if($item->difference > 0)

                                <span class="text-green-600 font-semibold">
                                    +{{ $item->difference }}
                                </span>

                            @elseif($item->difference < 0)

                                <span class="text-red-600 font-semibold">
                                    {{ $item->difference }}
                                </span>

                            @else

                                <span class="text-slate-600">
                                    0
                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            {{ $item->user->name }}

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('stock-opnames.show', $item->id) }}"
                                    class="px-3 py-2 bg-sky-500 text-white rounded-lg hover:bg-sky-600">

                                    <i class="bi bi-eye"></i>

                                </a>

                                <form action="{{ route('stock-opnames.destroy', $item->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">

                                        <i class="bi bi-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7"
                            class="px-6 py-10 text-center text-slate-500">

                            Belum ada data Stock Opname.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="mt-5">

    {{ $stockOpnames->links() }}

</div>

@endsection