<div class="grid gap-6">

    {{-- Nama Supplier --}}
    <div>
        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">
            Nama Supplier <span class="text-red-500">*</span>
        </label>

        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name', $supplier->name ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 @error('name') border-red-500 @enderror"
            placeholder="Masukkan nama supplier">

        @error('name')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900">
            Email
        </label>

        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email', $supplier->email ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="supplier@email.com">

        @error('email')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- No Telepon --}}
    <div>
        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">
            No. Telepon
        </label>

        <input
            type="text"
            id="phone"
            name="phone"
            value="{{ old('phone', $supplier->phone ?? '') }}"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="08xxxxxxxxxx">

        @error('phone')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Alamat --}}
    <div>
        <label for="address" class="block mb-2 text-sm font-medium text-gray-900">
            Alamat
        </label>

        <textarea
            id="address"
            name="address"
            rows="4"
            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
            placeholder="Masukkan alamat supplier">{{ old('address', $supplier->address ?? '') }}</textarea>

        @error('address')
            <p class="mt-1 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

</div>