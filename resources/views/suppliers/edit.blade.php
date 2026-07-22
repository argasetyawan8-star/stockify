@extends('layouts.app')

@section('content')

<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200">
    <div>
        <h1 class="text-2xl font-semibold text-gray-900">
            Edit Supplier
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Perbarui data supplier.
        </p>
    </div>
</div>

<div class="p-4">
    <div class="bg-white rounded-lg shadow p-6">

        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">

            @csrf
            @method('PUT')

            @include('suppliers._form')

            <div class="mt-6 flex justify-end gap-3">

                <a href="{{ route('suppliers.index') }}"
                    class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">

                    Kembali

                </a>

                <button type="submit"
                    class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700">

                    Update

                </button>

            </div>

        </form>

    </div>
</div>

@endsection