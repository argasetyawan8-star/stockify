@can('manage products')

<form
    action="{{ isset($product)
        ? route('products.update', $product->id)
        : route('products.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    @if(isset($product))
        @method('PUT')
    @endif


    <div class="bg-white rounded-lg shadow p-6">

        {{-- Header --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ isset($product) ? 'Edit Produk' : 'Tambah Produk' }}
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Isi informasi produk dengan lengkap dan benar.
            </p>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


            {{-- Category --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Kategori
                </label>

                <select 
                    name="category_id"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >

                    <option value="">
                        -- Pilih Kategori --
                    </option>

                    @foreach($categories as $category)

                        <option 
                            value="{{ $category->id }}"
                            {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @endforeach

                </select>


                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>



            {{-- Supplier --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Supplier
                </label>

                <select 
                    name="supplier_id"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >

                    <option value="">
                        -- Pilih Supplier --
                    </option>


                    @foreach($suppliers as $supplier)

                        <option 
                            value="{{ $supplier->id }}"
                            {{ old('supplier_id', $product->supplier_id ?? '') == $supplier->id ? 'selected' : '' }}
                        >
                            {{ $supplier->name }}
                        </option>

                    @endforeach


                </select>


                @error('supplier_id')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            {{-- Nama Produk --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Nama Produk
                </label>


                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $product->name ?? '') }}"
                    placeholder="Masukkan nama produk"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >


                @error('name')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            {{-- SKU --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    SKU
                </label>


                <input
                    type="text"
                    name="sku"
                    value="{{ old('sku', $product->sku ?? '') }}"
                    placeholder="Contoh: PRD-001"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >


                @error('sku')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>





            {{-- Harga Beli --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Harga Beli
                </label>


                <input
                    type="number"
                    name="purchase_price"
                    value="{{ old('purchase_price', $product->purchase_price ?? '') }}"
                    placeholder="0"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >


                @error('purchase_price')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            {{-- Harga Jual --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Harga Jual
                </label>


                <input
                    type="number"
                    name="selling_price"
                    value="{{ old('selling_price', $product->selling_price ?? '') }}"
                    placeholder="0"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >


                @error('selling_price')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>




            {{-- Minimum Stock --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Minimum Stock
                </label>


                <input
                    type="number"
                    name="minimum_stock"
                    value="{{ old('minimum_stock', $product->minimum_stock ?? 0) }}"
                    placeholder="0"
                    class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                >


                @error('minimum_stock')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


        </div>




        {{-- Description --}}
        <div class="mt-5">

            <label class="block mb-2 text-sm font-medium text-gray-700">
                Deskripsi
            </label>


            <textarea
                name="description"
                rows="4"
                placeholder="Masukkan deskripsi produk"
                class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500"
            >{{ old('description', $product->description ?? '') }}</textarea>


            @error('description')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>





        {{-- Image --}}
        <div class="mt-5">

            <label class="block mb-2 text-sm font-medium text-gray-700">
                Gambar Produk
            </label>


            <input
                type="file"
                name="image"
                class="w-full rounded-lg border-gray-300"
            >


            @error('image')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror



            @if(isset($product) && $product->image)

                <div class="mt-3">

                    <p class="text-sm text-gray-500 mb-2">
                        Gambar saat ini:
                    </p>


                    <img 
                        src="{{ asset('storage/'.$product->image) }}"
                        class="w-32 h-32 object-cover rounded-lg"
                    >

                </div>

            @endif


        </div>

        {{-- Product Attributes --}}
<div class="mt-8">

    <div class="flex items-center justify-between mb-4">

        <div>
            <h3 class="text-lg font-semibold text-gray-800">
                Atribut Produk
            </h3>

            <p class="text-sm text-gray-500">
                Tambahkan atribut tambahan sesuai kebutuhan produk.
            </p>
        </div>

        <button
            type="button"
            id="add-attribute"
            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm">

            <i class="bi bi-plus-circle me-1"></i>

            Tambah Atribut

        </button>

    </div>



    <div id="attribute-container">

        @php
            $oldAttributes = old('attributes');

            if (!$oldAttributes && isset($product)) {
                $oldAttributes = $product->attributes->map(function ($item) {
                    return [
                        'name' => $item->attribute_name,
                        'value' => $item->attribute_value,
                    ];
                })->toArray();
            }
        @endphp


        @if($oldAttributes)

            @foreach($oldAttributes as $index => $attribute)

                <div class="attribute-row grid grid-cols-12 gap-3 mb-3">

                    <div class="col-span-5">

                        <input
                            type="text"
                            name="attributes[{{ $index }}][name]"
                            value="{{ $attribute['name'] }}"
                            placeholder="Nama Attribute"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                    </div>

                    <div class="col-span-5">

                        <input
                            type="text"
                            name="attributes[{{ $index }}][value]"
                            value="{{ $attribute['value'] }}"
                            placeholder="Nilai Attribute"
                            class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                    </div>

                    <div class="col-span-2">

                        <button
                            type="button"
                            class="remove-attribute w-full px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">

                            <i class="bi bi-trash"></i>

                        </button>

                    </div>

                </div>

            @endforeach

        @else

            <div class="attribute-row grid grid-cols-12 gap-3 mb-3">

                <div class="col-span-5">

                    <input
                        type="text"
                        name="attributes[0][name]"
                        placeholder="Nama Attribute"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <div class="col-span-5">

                    <input
                        type="text"
                        name="attributes[0][value]"
                        placeholder="Nilai Attribute"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <div class="col-span-2">

                    <button
                        type="button"
                        class="remove-attribute w-full px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">

                        <i class="bi bi-trash"></i>

                    </button>

                </div>

            </div>

        @endif

    </div>

</div>




        {{-- Button --}}
        <div class="flex justify-end gap-3 mt-8">


            <a 
                href="{{ route('products.index') }}"
                class="px-5 py-2 rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-300"
            >
                Kembali
            </a>



            <button
                type="submit"
                class="px-5 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700"
            >
                {{ isset($product) ? 'Update Produk' : 'Simpan Produk' }}
            </button>


        </div>



    </div>

        <script>

document.addEventListener('DOMContentLoaded', function () {

    let index = document.querySelectorAll('.attribute-row').length;

    const container = document.getElementById('attribute-container');

    document.getElementById('add-attribute').addEventListener('click', function () {

        const html = `
            <div class="attribute-row grid grid-cols-12 gap-3 mb-3">

                <div class="col-span-5">

                    <input
                        type="text"
                        name="attributes[${index}][name]"
                        placeholder="Nama Attribute"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <div class="col-span-5">

                    <input
                        type="text"
                        name="attributes[${index}][value]"
                        placeholder="Nilai Attribute"
                        class="w-full rounded-lg border-gray-300 focus:ring-blue-500 focus:border-blue-500">

                </div>

                <div class="col-span-2">

                    <button
                        type="button"
                        class="remove-attribute w-full px-3 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg">

                        <i class="bi bi-trash"></i>

                    </button>

                </div>

            </div>
        `;

        container.insertAdjacentHTML('beforeend', html);

        index++;

    });


    container.addEventListener('click', function(e){

        if(e.target.closest('.remove-attribute')){

            e.target.closest('.attribute-row').remove();

        }

    });

});
</script>

</form>
@endcan