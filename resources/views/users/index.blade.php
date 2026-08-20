@extends('layouts.app')

@section('content')


<div class="w-full">

    <div class=" px-6 py-4">


        <div class="max-w-[1700px] mx-auto">



            {{-- HEADER --}}
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">


                <div class="flex items-center gap-4">


                    <div class="w-14 h-14 rounded-2xl bg-blue-100 flex items-center justify-center">


                        <i class="bi bi-people-fill text-blue-600 text-2xl"></i>


                    </div>




                    <div>


                        <h1 class="text-3xl font-bold text-slate-800">

                            User Management

                        </h1>



                        <p class="text-slate-500">

                            Kelola pengguna dan hak akses Stockify

                        </p>



                    </div>


                </div>







                @can('manage users')


                <a href="{{ route('users.create') }}"
                    class="mt-5 md:mt-0 inline-flex items-center gap-2 px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-xl shadow transition">


                    <i class="bi bi-person-plus"></i>


                    Tambah User


                </a>


                @endcan



            </div>







            {{-- ALERT --}}

            @if(session('success'))


            <div class="mb-6 flex items-center gap-2 p-4 rounded-xl bg-green-100 text-green-700">


                <i class="bi bi-check-circle-fill"></i>


                {{ session('success') }}


            </div>


            @endif







            {{-- CARD TABLE --}}


            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">





                {{-- Search --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-5">

    <form
        method="GET"
        action="{{ route('users.index') }}">

        <div class="flex gap-3">

            <div class="relative flex-1">

                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400"></i>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari User..."
                    class="w-full rounded-xl border-gray-300 pl-11 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500">

            </div>

            <button
                type="submit"
                class="px-6 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition">

                <i class="bi bi-search me-2"></i>

                

            </button>

        </div>

    </form>

</div>







                {{-- TABLE --}}


                <div class="overflow-x-auto">



                    <table class="w-full text-sm">



                        <thead class="bg-slate-50 text-slate-600">


                            <tr>


                                <th class="px-6 py-4 text-left">
                                    No
                                </th>


                                <th class="px-6 py-4 text-left">
                                    User
                                </th>


                                <th class="px-6 py-4 text-left">
                                    Role
                                </th>


                                <th class="px-6 py-4 text-left">
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


                                    {{ $users->firstItem()+$loop->index }}


                                </td>






                                {{-- USER --}}

                                <td class="px-6 py-4">


                                    <div class="flex items-center gap-3">



                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">


                                            <span class="font-bold text-blue-600">


                                                {{ strtoupper(substr($user->name,0,1)) }}


                                            </span>


                                        </div>




                                        <div>


                                            <p class="font-semibold text-slate-800">

                                                {{ $user->name }}

                                            </p>



                                            <p class="text-xs text-slate-500">

                                                {{ $user->email }}

                                            </p>


                                        </div>



                                    </div>


                                </td>









                                {{-- ROLE --}}


                                <td class="px-6 py-4">


                                    @php

                                    $role=$user->getRoleNames()->first();

                                    @endphp



                                    @if($role=="Admin")

                                        <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">

                                            Admin

                                        </span>



                                    @elseif($role=="Manajer Gudang")


                                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-700">

                                            Manajer Gudang

                                        </span>



                                    @elseif($role=="Staff Gudang")


                                        <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">

                                            Staff Gudang

                                        </span>


                                    @else

                                        <span class="px-3 py-1 text-xs rounded-full bg-gray-100">

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

                                            class="inline-flex items-center gap-2 rounded-lg bg-blue-500 px-4 py-2 text-sm font-medium text-white hover:bg-blue-600 transition">


                                            <i class="bi bi-eye"></i>
                                                <span>Detail</span>

                                        </a>


                                    @endcan





                                    @can('manage users')


                                        <a href="{{ route('users.edit',$user->id) }}"

                                            class="inline-flex items-center gap-2 rounded-lg bg-yellow-500 px-4 py-2 text-sm font-medium text-white hover:bg-yellow-600 transition">


                                            <i class="bi bi-pencil"></i>
                                                <span>Edit</span>

                                        </a>






                                        <form action="{{ route('users.destroy',$user->id) }}"
                                            method="POST">


                                            @csrf

                                            @method('DELETE')



                                            <button

                                            onclick="return confirm('Yakin ingin menghapus user ini?')"

                                            class="inline-flex items-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 transition">


                                                <i class="bi bi-trash"></i>
                                                <span>Hapus</span>

                                            </button>
                                            


                                        </form>



                                    @endcan



                                    </div>


                                </td>





                            </tr>





                        @empty



                            <tr>


                                <td colspan="5" class="py-12 text-center">


                                    <i class="bi bi-people text-5xl text-gray-300"></i>


                                    <p class="mt-3 text-gray-500">

                                        Belum ada user

                                    </p>


                                </td>


                            </tr>



                        @endforelse



                        </tbody>



                    </table>



                </div>



            </div>







            <div class="mt-6">

                {{ $users->links() }}

            </div>




        </div>


    </div>


</div>


@endsection