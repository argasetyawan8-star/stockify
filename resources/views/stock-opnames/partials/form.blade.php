<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Product --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-slate-700">
            Product
        </label>

        <select
            name="product_id"
            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

            <option value="">-- Select Product --</option>

            @foreach ($products as $product)
                <option
                    value="{{ $product->id }}"
                    {{ old('product_id') == $product->id ? 'selected' : '' }}>
                    {{ $product->name }} (Stock : {{ $product->stock }})
                </option>
            @endforeach

        </select>

        @error('product_id')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

    </div>

    {{-- Physical Stock --}}
    <div>

        <label class="block mb-2 text-sm font-semibold text-slate-700">
            Physical Stock
        </label>

        <input
            type="number"
            name="physical_stock"
            value="{{ old('physical_stock') }}"
            min="0"
            class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">

        @error('physical_stock')
            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
        @enderror

    </div>

</div>

<div class="mt-6">

    <label class="block mb-2 text-sm font-semibold text-slate-700">
        Notes
    </label>

    <textarea
        name="notes"
        rows="4"
        class="w-full rounded-xl border-slate-300 focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>

    @error('notes')
        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
    @enderror

</div>

<div class="flex justify-end gap-3 mt-8">

    <a href="{{ route('stock-opnames.index') }}"
        class="px-5 py-2 rounded-xl border border-slate-300 hover:bg-slate-100">

        Cancel

    </a>

    <button
        type="submit"
        class="px-5 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700">

        Save

    </button>

</div>