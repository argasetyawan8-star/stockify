<div class="grid grid-cols-1 md:grid-cols-2 gap-6">


    {{-- Nama --}}
    <div>

        <label class="block mb-2 text-sm font-semibold text-gray-700">

            Nama User
            <span class="text-red-500">*</span>

        </label>


        <input

            type="text"

            name="name"

            value="{{ old('name',$user->name ?? '') }}"

            placeholder="Masukkan nama user"

            class="w-full rounded-lg border
            @error('name')
                border-red-500
            @else
                border-gray-300
            @enderror

            focus:border-blue-500 focus:ring focus:ring-blue-200"

        >


        @error('name')

            <p class="mt-1 text-sm text-red-500">

                {{ $message }}

            </p>

        @enderror


    </div>





    {{-- Email --}}
    <div>


        <label class="block mb-2 text-sm font-semibold text-gray-700">


            Email

            <span class="text-red-500">*</span>


        </label>



        <input

            type="email"

            name="email"

            value="{{ old('email',$user->email ?? '') }}"

            placeholder="example@mail.com"

            class="w-full rounded-lg border

            @error('email')
                border-red-500
            @else
                border-gray-300
            @enderror

            focus:border-blue-500 focus:ring focus:ring-blue-200"

        >




        @error('email')

            <p class="mt-1 text-sm text-red-500">

                {{ $message }}

            </p>

        @enderror


    </div>







    {{-- Password --}}
    <div>


        <label class="block mb-2 text-sm font-semibold text-gray-700">


            Password


            @isset($user)

                <span class="text-xs text-gray-400">

                    (Kosongkan jika tidak ingin mengganti)

                </span>

            @else

                <span class="text-red-500">

                    *

                </span>

            @endisset


        </label>





        <div class="relative">


            <input

                id="password"

                type="password"

                name="password"

                placeholder="Minimal 8 karakter"

                class="w-full rounded-lg border

                @error('password')
                    border-red-500
                @else
                    border-gray-300
                @enderror

                focus:border-blue-500 focus:ring focus:ring-blue-200"

            >


            <button

                type="button"

                id="togglePassword"

                class="absolute right-3 top-3 text-gray-400 hover:text-blue-600"

            >

                <i class="bi bi-eye"></i>

            </button>



        </div>





        @error('password')

            <p class="mt-1 text-sm text-red-500">

                {{ $message }}

            </p>

        @enderror



    </div>







    {{-- Role --}}
    <div>


        <label class="block mb-2 text-sm font-semibold text-gray-700">


            Role

            <span class="text-red-500">*</span>


        </label>




        <select

            name="role"

            class="w-full rounded-lg border

            @error('role')
                border-red-500
            @else
                border-gray-300
            @enderror

            focus:border-blue-500 focus:ring focus:ring-blue-200"

        >



            <option value="">

                -- Pilih Role --

            </option>




            @foreach($roles as $role)


                <option

                    value="{{ $role->name }}"

                    @selected(

                        old(

                            'role',

                            isset($user)

                            ? $user->getRoleNames()->first()

                            : ''

                        )

                        ==

                        $role->name

                    )

                    >

                    {{ $role->name }}


                </option>


            @endforeach



        </select>





        @error('role')

            <p class="mt-1 text-sm text-red-500">

                {{ $message }}

            </p>

        @enderror


    </div>


</div>







{{-- Button --}}

<div class="flex justify-end gap-3 mt-8">



    <a

        href="{{ route('users.index') }}"

        class="px-5 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 text-gray-700 transition"

    >

        <i class="bi bi-arrow-left mr-1"></i>

        Kembali


    </a>





    <button

        type="submit"

        class="px-5 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white transition"

    >


        <i class="bi bi-check-circle mr-1"></i>


        {{ isset($user) ? 'Update User' : 'Tambah User' }}



    </button>



</div>






<script>

document.addEventListener('DOMContentLoaded', function(){


    const password =
        document.getElementById('password');


    const toggle =
        document.getElementById('togglePassword');



    if(toggle)
    {


        toggle.addEventListener('click', function(){


            if(password.type === 'password')
            {

                password.type = 'text';

                toggle.innerHTML =
                '<i class="bi bi-eye-slash"></i>';

            }

            else
            {

                password.type = 'password';

                toggle.innerHTML =
                '<i class="bi bi-eye"></i>';

            }


        });


    }



});


</script>