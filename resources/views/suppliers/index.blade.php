@extends('layouts.app')

@section('content')

<div class="p-4 bg-white border-b border-gray-200">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>

            <nav class="flex mb-2" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-2 text-sm text-gray-500">

                    <li>
                        <a href="{{ route('dashboard') }}"
                           class="hover:text-blue-600 font-medium">
                            Dashboard
                        </a>
                    </li>

                    <li>/</li>

                    <li class="text-gray-700 font-semibold">
                        Supplier
                    </li>

                </ol>
            </nav>

            <h1 class="text-3xl font-bold text-gray-900">
                Data Supplier
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Kelola seluruh data supplier Stockify.
            </p>

        </div>

        @can('manage suppliers')

<a href="{{ route('suppliers.create') }}"
   class="inline-flex items-center gap-2 px-5 py-3 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">

    <i class="bi bi-plus-circle"></i>

    Tambah Supplier

</a>

@endcan

    </div>

</div>

<div class="p-4">

    {{-- Alert --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg bg-green-100 border border-green-300 p-4 text-green-700">

            {{ session('success') }}

        </div>

    @endif

    {{-- Search --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-5">

        <div class="relative max-w-md">

            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>

                </svg>

            </span>

            <input
                type="text"
                placeholder="Cari supplier..."
                class="w-full rounded-lg border-gray-300 pl-10 focus:border-blue-500 focus:ring-blue-500">

        </div>

    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow border border-gray-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">
                            No
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">
                            Nama Supplier
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">
                            Email
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">
                            Telepon
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold uppercase">
                            Alamat
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold uppercase">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-200">

                @forelse($suppliers as $supplier)

                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-4 font-medium">
                        {{ $supplier->name }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $supplier->email ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $supplier->phone ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        {{ $supplier->address ?? '-' }}
                    </td>

                   <td class="px-6 py-4">

    <div class="flex justify-center items-center gap-2">


        @can('manage suppliers')

            <a href="{{ route('suppliers.edit',$supplier->id) }}"
               class="inline-flex items-center gap-2 rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-white hover:bg-amber-600 transition">

                <i class="bi bi-pencil-square"></i>

                Edit

            </a>


            <form
                action="{{ route('suppliers.destroy',$supplier->id) }}"
                method="POST"
                class="inline">

                @csrf

                @method('DELETE')


                <button
                    type="submit"
                    onclick="return confirm('Yakin ingin menghapus supplier ini?')"
                    class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 transition">


                    <i class="bi bi-trash"></i>

                    Hapus


                </button>


            </form>


        @else

            <span class="text-sm text-gray-400">
                Tidak ada aksi
            </span>

        @endcan


    </div>

</td>

                </tr>
                                @empty

                <tr>

                    <td colspan="6" class="px-6 py-12 text-center">

                        <div class="flex flex-col items-center">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-16 h-16 text-gray-300 mb-4"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M20 13V7a2 2 0 00-2-2h-3V3H9v2H6a2 2 0 00-2 2v6m16 0v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4m16 0H4"/>

                            </svg>

                            <h3 class="text-lg font-semibold text-gray-700">
                                Belum Ada Supplier
                            </h3>

                            <p class="text-gray-500 mt-2">
                                Silakan tambahkan supplier pertama Anda.
                            </p>

                            @can('manage suppliers')

                            <a href="{{ route('suppliers.create') }}"
                            class="mt-5 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700 transition">

                            <i class="bi bi-plus-circle"></i>

                            Tambah Supplier

                            </a>

                            @endcan

                        </div>

                    </td>

                </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- Pagination --}}
    <div class="mt-6">

        {{ $suppliers->links() }}

    </div>

</div>

@endsection