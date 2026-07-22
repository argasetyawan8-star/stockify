@extends('layouts.app')

@section('content')

<div class="p-6">


    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                User Management
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola pengguna dan hak akses Stockify.
            </p>

        </div>


        @can('manage users')

        <a href="{{ route('users.create') }}"
            class="inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow transition">

            <i class="bi bi-person-plus"></i>

            Tambah User

        </a>

        @endcan


    </div>




    {{-- ALERT --}}

    @if(session('success'))

        <div class="mb-5 px-4 py-3 rounded-xl bg-green-100 border border-green-200 text-green-700">

            {{ session('success') }}

        </div>

    @endif






    {{-- TABLE CARD --}}

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">


        {{-- SEARCH --}}

        <div class="p-5 border-b border-slate-200">

            <form method="GET"
                  action="{{ route('users.index') }}">


                <div class="relative max-w-md">


                    <i class="bi bi-search absolute left-3 top-3 text-slate-400"></i>


                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau email..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border-slate-300 focus:ring-blue-500 focus:border-blue-500">


                </div>


            </form>


        </div>






        {{-- TABLE --}}

        <div class="overflow-x-auto">


            <table class="w-full text-sm text-left">


                <thead class="bg-slate-100 text-slate-700">


                    <tr>


                        <th class="px-6 py-4">
                            No
                        </th>


                        <th class="px-6 py-4">
                            Nama
                        </th>


                        <th class="px-6 py-4">
                            Email
                        </th>


                        <th class="px-6 py-4">
                            Role
                        </th>


                        <th class="px-6 py-4">
                            Dibuat
                        </th>


                        <th class="px-6 py-4 text-center">
                            Aksi
                        </th>


                    </tr>


                </thead>





                <tbody>


                @forelse($users as $user)


                    <tr class="border-b hover:bg-slate-50 transition">



                        <td class="px-6 py-4">

                            {{ $users->firstItem() + $loop->index }}

                        </td>




                        <td class="px-6 py-4 font-semibold text-slate-800">

                            {{ $user->name }}

                        </td>




                        <td class="px-6 py-4 text-slate-600">

                            {{ $user->email }}

                        </td>






                        {{-- ROLE --}}

                        <td class="px-6 py-4">


                            @php

                                $role = $user->getRoleNames()->first();

                            @endphp



                            @if($role == 'Admin')


                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">

                                    Admin

                                </span>



                            @elseif($role == 'Manajer Gudang')


                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">

                                    Manajer Gudang

                                </span>



                            @elseif($role == 'Staff Gudang')


                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">

                                    Staff Gudang

                                </span>



                            @else


                                <span class="px-3 py-1 text-xs rounded-full bg-gray-100 text-gray-700">

                                    Belum Ada Role

                                </span>


                            @endif



                        </td>






                        <td class="px-6 py-4 text-slate-600">

                            {{ $user->created_at->format('d M Y') }}

                        </td>






                        {{-- ACTION --}}

                        <td class="px-6 py-4">


                            <div class="flex justify-center gap-2">



                                @can('view users')


                                <a href="{{ route('users.show',$user->id) }}"
                                    class="px-3 py-2 rounded-lg bg-slate-200 hover:bg-slate-300 transition">


                                    <i class="bi bi-eye"></i>


                                </a>


                                @endcan





                                @can('manage users')


                                <a href="{{ route('users.edit',$user->id) }}"
                                    class="px-3 py-2 rounded-lg bg-yellow-500 hover:bg-yellow-600 text-white transition">


                                    <i class="bi bi-pencil-square"></i>


                                </a>





                                <form
                                    action="{{ route('users.destroy',$user->id) }}"
                                    method="POST">


                                    @csrf

                                    @method('DELETE')



                                    <button

                                        onclick="return confirm('Yakin ingin menghapus user ini?')"

                                        class="px-3 py-2 rounded-lg bg-red-600 hover:bg-red-700 text-white transition">


                                        <i class="bi bi-trash"></i>


                                    </button>



                                </form>



                                @endcan




                            </div>


                        </td>




                    </tr>



                @empty



                    <tr>


                        <td colspan="6"
                            class="px-6 py-12 text-center">


                            <i class="bi bi-people text-5xl text-slate-300"></i>


                            <p class="mt-3 text-slate-500">

                                Belum ada data user.

                            </p>


                        </td>


                    </tr>



                @endforelse



                </tbody>


            </table>


        </div>



    </div>





    {{-- PAGINATION --}}

    <div class="mt-6">

        {{ $users->links() }}

    </div>




</div>


@endsection