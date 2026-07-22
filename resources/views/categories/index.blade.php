@extends('layouts.app')

@section('title', 'Categories')

@section('content')

<div class="p-6">


    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">


        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Categories
            </h1>


            <p class="mt-1 text-sm text-slate-500">
                Kelola kategori produk Stockify.
            </p>

        </div>



        @can('manage categories')

        <a href="{{ route('categories.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white transition shadow">


            <i class="bi bi-plus-circle"></i>

            Tambah Category


        </a>

        @endcan


    </div>




    {{-- Alert --}}
    @if(session('success'))

        <div class="mb-5 rounded-xl bg-green-100 border border-green-300 px-5 py-3 text-green-700">

            {{ session('success') }}

        </div>

    @endif





    {{-- Table --}}

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">


        <div class="overflow-x-auto">


            <table class="w-full text-sm text-left text-slate-600">


                <thead class="bg-slate-100 text-xs uppercase text-slate-700">


                    <tr>


                        <th class="px-6 py-4">
                            No
                        </th>


                        <th class="px-6 py-4">
                            Nama Category
                        </th>


                        <th class="px-6 py-4">
                            Deskripsi
                        </th>


                        <th class="px-6 py-4">
                            Dibuat
                        </th>



                        @can('manage categories')

                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>

                        @endcan



                    </tr>


                </thead>





                <tbody>


                @forelse($categories as $category)



                    <tr class="border-b hover:bg-slate-50 transition">


                        <td class="px-6 py-4">

                            {{ $loop->iteration }}

                        </td>




                        <td class="px-6 py-4 font-semibold text-slate-800">

                            {{ $category->name }}

                        </td>




                        <td class="px-6 py-4">

                            {{ $category->description ?? '-' }}

                        </td>




                        <td class="px-6 py-4">

                            {{ $category->created_at->format('d M Y') }}

                        </td>




                        @can('manage categories')

                        <td class="px-6 py-4">


                            <div class="flex justify-center gap-2">


                                {{-- Edit --}}

                                <a href="{{ route('categories.edit',$category->id) }}"
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white">


                                    <i class="bi bi-pencil"></i>

                                    Edit


                                </a>






                                {{-- Delete --}}

                                <form
                                    action="{{ route('categories.destroy',$category->id) }}"
                                    method="POST">


                                    @csrf

                                    @method('DELETE')



                                    <button
                                        onclick="return confirm('Yakin ingin menghapus category ini?')"
                                        class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white">


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


                        <td
                            colspan="@can('manage categories') 5 @else 4 @endcan"
                            class="px-6 py-10 text-center text-slate-500">


                            Belum ada data category.


                        </td>


                    </tr>



                @endforelse



                </tbody>


            </table>



        </div>



    </div>





    {{-- Pagination --}}

    <div class="mt-6">

        {{ $categories->links() }}

    </div>



</div>


@endsection