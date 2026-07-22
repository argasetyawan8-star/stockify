@if(session('error'))
    <div class="mb-4 p-4 rounded-lg bg-red-100 text-red-700">
        {{ session('error') }}
    </div>
@endif

<form 
    action="{{ isset($transaction) 
        ? route('stock-transactions.update', $transaction->id) 
        : route('stock-transactions.store') }}"
    method="POST"
>

    @csrf

    @if(isset($transaction))
        @method('PUT')
    @endif


    <div class="space-y-6">


        {{-- Product --}}
        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900">
                Produk
            </label>

            <select 
                name="product_id"
                class="w-full rounded-lg border-gray-300"
            >

                <option value="">
                    -- Pilih Produk --
                </option>


                @foreach($products as $product)

                    <option 
                        value="{{ $product->id }}"

                        @selected(
                            old('product_id', 
                            $transaction->product_id ?? '') 
                            == $product->id
                        )
                    >

                        {{ $product->name }}

                    </option>

                @endforeach

            </select>


            @error('product_id')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>



        {{-- Type --}}
        <div>

            <label class="block mb-2 text-sm font-medium text-gray-900">
                Jenis Transaksi
            </label>


            <select 
                name="type"
                class="w-full rounded-lg border-gray-300"
            >

                <option value="">
                    -- Pilih Jenis --
                </option>


                <option 
                    value="IN"
                    @selected(old('type',
                    $transaction->type ?? '') == 'IN')
                >
                    Stock In
                </option>


                <option 
                    value="OUT"
                    @selected(old('type',
                    $transaction->type ?? '') == 'OUT')
                >
                    Stock Out
                </option>


                <option 
                    value="OPNAME"
                    @selected(old('type',
                    $transaction->type ?? '') == 'OPNAME')
                >
                    Stock Opname
                </option>


            </select>


            @error('type')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror


        </div>




        <div class="grid grid-cols-2 gap-6">


            {{-- Quantity --}}
            <div>

                <label class="block mb-2 text-sm font-medium">
                    Jumlah
                </label>


                <input 
                    type="number"
                    name="quantity"

                    value="{{ old(
                        'quantity',
                        $transaction->quantity ?? ''
                    ) }}"

                    class="w-full rounded-lg border-gray-300"
                >


                @error('quantity')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror


            </div>



            {{-- Price --}}
            <div>

                <label class="block mb-2 text-sm font-medium">
                    Harga
                </label>


                <input 
                    type="number"
                    name="price"

                    value="{{ old(
                        'price',
                        $transaction->price ?? ''
                    ) }}"

                    class="w-full rounded-lg border-gray-300"
                >


                @error('price')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror


            </div>


        </div>




        {{-- Date --}}
        <div>

            <label class="block mb-2 text-sm font-medium">
                Tanggal Transaksi
            </label>


            <input 
                type="date"
                name="transaction_date"

                value="{{ old(
                    'transaction_date',
                    isset($transaction)
                    ? $transaction->transaction_date
                    : date('Y-m-d')
                ) }}"

                class="w-full rounded-lg border-gray-300"
            >


            @error('transaction_date')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror


        </div>




        {{-- Description --}}
        <div>

            <label class="block mb-2 text-sm font-medium">
                Keterangan
            </label>


            <textarea
                name="description"
                rows="4"

                class="w-full rounded-lg border-gray-300"
            >{{ old(
                'description',
                $transaction->description ?? ''
            ) }}</textarea>


            @error('description')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror


        </div>




        {{-- Button --}}

        <div class="flex justify-end gap-3">


            <a 
                href="{{ route('stock-transactions.index') }}"
                class="px-5 py-2 rounded-lg bg-gray-200"
            >
                Kembali
            </a>


            <button 
                type="submit"
                class="px-5 py-2 rounded-lg bg-blue-600 text-white"
            >

                {{ isset($transaction)
                    ? 'Update'
                    : 'Simpan'
                }}

            </button>


        </div>


    </div>

</form>