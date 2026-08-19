        <!DOCTYPE html>
        <html lang="en">

        <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>
            Login | Stockify
        </title>


        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])


        <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css"
        rel="stylesheet">


        </head>


        <body>


        <div
        class="
        min-h-screen
        relative
        overflow-hidden
        flex
        items-center
        justify-center
        bg-slate-50
        p-6
        ">


        {{-- BACKGROUND DECORATION --}}

        <div
        class="
        absolute
        top-0
        left-0
        w-72
        h-72
        bg-purple-200
        rounded-full
        blur-3xl
        opacity-40
        ">
        </div>


        <div
        class="
        absolute
        bottom-0
        right-0
        w-72
        h-72
        bg-blue-200
        rounded-full
        blur-3xl
        opacity-40
        ">
        </div>




        {{-- LOGIN CARD --}}

        <div

        class="
        relative
        z-10
        w-full
        max-w-md
        bg-white
        rounded-3xl
        shadow-xl
        border
        border-slate-100
        p-8
        animate-fade-in
        ">



        {{-- LOGO --}}

        <div

        class="
        flex
        justify-center
        mb-6
        ">


        <img

        src="{{ asset('images/images.jpeg') }}"

        alt="Stockify Logo"


        class="
        w-28
        h-28
        rounded-2xl
        object-cover
        shadow-lg
        animate-float
        hover:scale-110
        transition
        duration-500
        ">


        </div>





        {{-- BRANDING --}}

        <div

        class="
        text-center
        mb-8
        ">


        <h1

        class="
        text-3xl
        font-extrabold
        text-slate-800
        tracking-wide
        ">

        STOCKIFY

        </h1>



        <p

        class="
        text-sm
        text-slate-500
        mt-2
        ">

        Inventory Management System

        </p>



        <div

        class="
        mt-4
        flex
        justify-center
        ">


        <span

        class="
        inline-flex
        items-center
        gap-2
        px-4
        py-2
        rounded-full
        bg-purple-50
        text-purple-600
        text-xs
        font-semibold
        ">


        <span

        class="
        w-2
        h-2
        bg-green-500
        rounded-full
        animate-pulse
        ">

        </span>


        Smart Warehouse Solution


        </span>


        </div>



        <p

        class="
        mt-5
        text-sm
        text-slate-500
        leading-relaxed
        ">

        Kelola stok barang dengan mudah,
        cepat, dan akurat.


        </p>


        </div>







        {{-- FORM LOGIN --}}

        <form

        method="POST"

        action="{{ route('login') }}">

        @csrf




        {{-- EMAIL --}}

        <div

        class="
        mb-5
        ">


        <label

        class="
        block
        text-sm
        font-semibold
        text-slate-700
        mb-2
        ">

        Email Address

        </label>



        <div

        class="
        relative
        ">


        <i

        class="
        bi bi-envelope-fill
        absolute
        left-4
        top-3.5
        text-slate-400
        ">

        </i>



        <input

        type="email"

        name="email"

        value="{{ old('email') }}"

        required

        autofocus


        placeholder="admin@gmail.com"


        class="
        w-full
        rounded-xl
        border
        border-slate-200
        bg-slate-50
        pl-11
        py-3
        outline-none
        transition
        focus:bg-white
        focus:border-purple-500
        focus:ring-4
        focus:ring-purple-100
        ">


        </div>



        @error('email')

        <p

        class="
        text-sm
        text-red-500
        mt-2
        ">

        {{ $message }}

        </p>

        @enderror


        </div>







        {{-- PASSWORD --}}

        <div

        class="
        mb-5
        ">


        <label

        class="
        block
        text-sm
        font-semibold
        text-slate-700
        mb-2
        ">

        Password

        </label>



        <div

        class="
        relative
        ">


        <i

        class="
        bi bi-lock-fill
        absolute
        left-4
        top-3.5
        text-slate-400
        ">

        </i>



        <input

        type="password"

        name="password"

        required


        placeholder="********"


        class="
        w-full
        rounded-xl
        border
        border-slate-200
        bg-slate-50
        pl-11
        py-3
        outline-none
        transition
        focus:bg-white
        focus:border-purple-500
        focus:ring-4
        focus:ring-purple-100
        ">


        </div>



        @error('password')

        <p

        class="
        text-sm
        text-red-500
        mt-2
        ">

        {{ $message }}

        </p>

        @enderror


        </div>







        {{-- REMEMBER --}}

        <div

        class="
        flex
        items-center
        mb-6
        ">


        <input

        type="checkbox"

        name="remember"


        class="
        rounded
        border-slate-300
        text-purple-600
        focus:ring-purple-500
        ">


        <span

        class="
        ml-2
        text-sm
        text-slate-600
        ">

        Remember me

        </span>


        </div>







        {{-- BUTTON --}}

        <button

        type="submit"


        class="
        w-full
        bg-gradient-to-r
        from-purple-600
        to-blue-600
        hover:from-purple-700
        hover:to-blue-700
        text-white
        font-semibold
        py-3
        rounded-xl
        shadow-lg
        transition
        duration-300
        hover:-translate-y-1
        hover:shadow-2xl
        active:scale-95
        ">


        <i

        class="
        bi bi-box-arrow-in-right
        mr-2
        ">

        </i>


        Login


        </button>




        </form>







        {{-- FOOTER --}}

        <div

        class="
        text-center
        mt-8
        text-sm
        text-slate-400
        ">


        © {{ date('Y') }}

        <span

        class="
        font-bold
        text-slate-600
        ">

        STOCKIFY

        </span>


        <p

        class="
        text-xs
        mt-1
        ">

        Inventory Management System

        </p>


        </div>



        </div>


        </div>



        </body>

        </html>