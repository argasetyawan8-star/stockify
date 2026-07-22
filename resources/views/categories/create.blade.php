@extends('layouts.app')

@section('content')

<div class="px-4 pt-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold">
                Add Category
            </h1>

            <p class="text-gray-500 mt-1">
                Create new product category.
            </p>
        </div>

        <a href="{{ route('categories.index') }}"
            class="text-white bg-gray-600 hover:bg-gray-700 font-medium rounded-lg text-sm px-5 py-2.5">
            Back
        </a>

    </div>

    <div class="bg-white shadow rounded-lg p-6">

        <form action="{{ route('categories.store') }}" method="POST">

            @csrf

            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium">
                    Category Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5"
                >{{ old('description') }}</textarea>

            </div>

            <button
                type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg px-5 py-2.5"
            >
                Save Category
            </button>

        </form>

    </div>

</div>

@endsection