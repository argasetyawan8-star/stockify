@extends('layouts.app')


@section('content')

<div class="py-8">

    <div class="mx-auto max-w-5xl space-y-6">


        {{-- HEADER --}}
        <div class="rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-white shadow">


            <div class="flex items-center gap-4">


                <div
                    class="flex h-16 w-16 items-center justify-center rounded-full bg-white text-2xl font-bold text-blue-600">

                    {{ strtoupper(substr(Auth::user()->name,0,1)) }}

                </div>


                <div>

                    <h1 class="text-2xl font-bold">
                        My Profile
                    </h1>


                   <p class="text-blue-100">
    Kelola informasi akun Stockify
</p>

<span class="mt-2 inline-block rounded-full bg-white/20 px-3 py-1 text-xs">

    Role:
    {{ Auth::user()->getRoleNames()->first() }}

</span>


                </div>


            </div>


        </div>




        {{-- PROFILE INFORMATION --}}
        <div class="rounded-xl bg-white p-6 shadow">


            <h2 class="mb-2 text-lg font-bold text-gray-800">
                Informasi Profil
            </h2>


            <p class="mb-5 text-sm text-gray-500">
                Update nama dan email akun.
            </p>

            <p class="text-sm text-blue-100">
    {{ Auth::user()->email }}
</p>


            @include(
                'profile.partials.update-profile-information-form'
            )


        </div>




        {{-- UPDATE PASSWORD --}}
        <div class="rounded-xl bg-white p-6 shadow">


            <h2 class="mb-2 text-lg font-bold text-gray-800">
                Ubah Password
            </h2>


            <p class="mb-5 text-sm text-gray-500">
                Ganti password akun Anda.
            </p>



            @include(
                'profile.partials.update-password-form'
            )


        </div>


    </div>

</div>


@endsection