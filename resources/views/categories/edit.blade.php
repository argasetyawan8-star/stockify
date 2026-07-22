@extends('layouts.app')

@section('content')

<div class="px-4 pt-6">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Edit Category
            </h1>

            <p class="text-gray-500 mt-1">
                Update product category.
            </p>
        </div>

        <a href="{{ route('categories.index') }}"
           class="px-5 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            Back
        </a>

    </div>

    <div class="bg-white rounded-lg shadow p-6">

        <form action="{{ route('categories.update', $category->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="mb-5">

                <label class="block mb-2 text-sm font-medium">
                    Category Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $category->name) }}"
                    class="w-full rounded-lg border-gray-300"
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
                    class="w-full rounded-lg border-gray-300"
                >{{ old('description', $category->description) }}</textarea>

            </div>

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Update Category

            </button>

        </form>

    </div>

</div>

@endsection