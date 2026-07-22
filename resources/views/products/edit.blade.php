@extends('layouts.app')

@section('content')

@can('manage products')

<div class="p-4">

    @include('products._form')

</div>

@endcan

@endsection