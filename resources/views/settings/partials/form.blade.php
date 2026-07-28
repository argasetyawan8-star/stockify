<div class="space-y-6">

    {{-- Informasi Aplikasi --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

        <div class="flex items-center gap-2 mb-5">
            <i class="bi bi-window text-blue-600 text-xl"></i>

            <h3 class="text-lg font-semibold text-gray-800">
                Informasi Aplikasi
            </h3>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


            {{-- Nama Aplikasi --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Nama Aplikasi
                </label>

                <input
                    type="text"
                    name="app_name"
                    value="{{ old('app_name', $setting->app_name ?? '') }}"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Contoh: Stockify">

                @error('app_name')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror
            </div>



            {{-- Logo --}}
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Logo Aplikasi
                </label>

                <input
                    type="file"
                    name="logo"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">

                @error('logo')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror


                @if(isset($setting) && $setting->logo)

                    <div class="mt-3">
                        <img
                            src="{{ asset('storage/'.$setting->logo) }}"
                            class="h-20 rounded-lg border p-2">
                    </div>

                @endif

            </div>



            {{-- Favicon --}}
            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Favicon
                </label>


                <input
                    type="file"
                    name="favicon"
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50">


                @error('favicon')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror



                @if(isset($setting) && $setting->favicon)

                    <div class="mt-3">
                        <img
                            src="{{ asset('storage/'.$setting->favicon) }}"
                            class="h-12 rounded border p-1">
                    </div>

                @endif

            </div>




            {{-- Deskripsi --}}
            <div class="md:col-span-2">

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Deskripsi Aplikasi
                </label>


                <textarea
                    name="description"
                    rows="4"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    placeholder="Deskripsi singkat aplikasi">

                    {{ old('description', $setting->description ?? '') }}

                </textarea>


                @error('description')
                    <p class="text-red-600 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>


        </div>

    </div>





    {{-- Informasi Perusahaan --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">


        <div class="flex items-center gap-2 mb-5">

            <i class="bi bi-building text-blue-600 text-xl"></i>

            <h3 class="text-lg font-semibold text-gray-800">
                Informasi Perusahaan
            </h3>

        </div>



        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">



            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Nama Perusahaan
                </label>


                <input
                    type="text"
                    name="company_name"
                    value="{{ old('company_name', $setting->company_name ?? '') }}"
                    class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5"
                    placeholder="Nama perusahaan">


            </div>




            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Email
                </label>


                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $setting->email ?? '') }}"
                    class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5"
                    placeholder="email@company.com">


            </div>




            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Nomor Telepon
                </label>


                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $setting->phone ?? '') }}"
                    class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5"
                    placeholder="08xxxxxxxxxx">

            </div>




            <div>

                <label class="block mb-2 text-sm font-medium text-gray-700">
                    Website
                </label>


                <input
                    type="text"
                    name="website"
                    value="{{ old('website', $setting->website ?? '') }}"
                    class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5"
                    placeholder="https://website.com">

            </div>


        </div>


    </div>





    {{-- Alamat --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">


        <div class="flex items-center gap-2 mb-5">

            <i class="bi bi-geo-alt text-blue-600 text-xl"></i>

            <h3 class="text-lg font-semibold text-gray-800">
                Alamat
            </h3>

        </div>


        <textarea
            name="address"
            rows="3"
            class="bg-gray-50 border border-gray-300 rounded-lg w-full p-2.5"
            placeholder="Alamat perusahaan">

            {{ old('address', $setting->address ?? '') }}

        </textarea>


    </div>





    {{-- Pengaturan Sistem --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">


        <div class="flex items-center gap-2 mb-5">

            <i class="bi bi-gear text-blue-600 text-xl"></i>

            <h3 class="text-lg font-semibold text-gray-800">
                Pengaturan Sistem
            </h3>

        </div>



        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


            <div>

                <label class="block mb-2 text-sm font-medium">
                    Minimum Stock
                </label>


                <input
                    type="number"
                    name="minimum_stock"
                    value="{{ old('minimum_stock', $setting->minimum_stock ?? 0) }}"
                    class="bg-gray-50 border rounded-lg w-full p-2.5">

            </div>




            <div>

                <label class="block mb-2 text-sm font-medium">
                    Pagination
                </label>


                <input
                    type="number"
                    name="default_pagination"
                    value="{{ old('default_pagination', $setting->default_pagination ?? 10) }}"
                    class="bg-gray-50 border rounded-lg w-full p-2.5">

            </div>




            <div>

                <label class="block mb-2 text-sm font-medium">
                    Timezone
                </label>


                <select
                    name="timezone"
                    class="bg-gray-50 border rounded-lg w-full p-2.5">


                    <option value="Asia/Jakarta">
                        Asia/Jakarta
                    </option>


                </select>

            </div>



            <div>

                <label class="block mb-2 text-sm font-medium">
                    Currency
                </label>


                <input
                    type="text"
                    name="currency"
                    value="{{ old('currency', $setting->currency ?? 'IDR') }}"
                    class="bg-gray-50 border rounded-lg w-full p-2.5">

            </div>


        </div>


    </div>



</div>