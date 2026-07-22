@extends('layouts.app')


@section('content')


<div class="p-6">


<div class="mb-6">


<h1 class="text-2xl font-bold">

Detail User

</h1>


<p class="text-gray-500">

Informasi lengkap pengguna

</p>


</div>





<div class="bg-white shadow rounded-xl p-6">


<div class="grid md:grid-cols-2 gap-6">


<div>

<p class="text-gray-500">
Nama
</p>


<h3 class="font-semibold text-lg">

{{ $user->name }}

</h3>

</div>






<div>

<p class="text-gray-500">
Email
</p>


<h3 class="font-semibold text-lg">

{{ $user->email }}

</h3>

</div>







<div>

<p class="text-gray-500">
Role
</p>


@if($user->roles->count())

<span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">

{{ $user->getRoleNames()->first() }}

</span>

@else

<span class="text-gray-400">

Belum memiliki role

</span>


@endif


</div>







<div>

<p class="text-gray-500">

Dibuat

</p>


<h3>

{{ $user->created_at->format('d M Y H:i') }}

</h3>


</div>





<div>

<p class="text-gray-500">

Update Terakhir

</p>


<h3>

{{ $user->updated_at->format('d M Y H:i') }}

</h3>


</div>


</div>





<div class="mt-6">


<a href="{{ route('users.index') }}"
class="px-4 py-2 bg-gray-200 rounded-lg">

Kembali

</a>


</div>



</div>


</div>


@endsection