@extends('layouts.app')

@section('title', 'Create Stock Opname')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-6">

        <h1 class="text-2xl font-bold text-slate-800">

            Create Stock Opname

        </h1>

        <p class="text-slate-500">

            Record physical stock to synchronize inventory.

        </p>

    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">

        <form
            action="{{ route('stock-opnames.store') }}"
            method="POST">

            @csrf

            @include('stock-opnames.partials.form')

        </form>

    </div>

</div>

@endsection