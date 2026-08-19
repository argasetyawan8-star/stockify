@php
    use Illuminate\Support\Facades\Auth;
@endphp

<header class="sticky top-0 z-10 bg-white border-b border-slate-200 shadow-sm">

    <div class="flex items-center justify-between px-6 py-4">

        {{-- Left --}}
        <div class="flex items-center gap-4">

            {{-- Mobile Menu --}}
            <button
                id="sidebarToggle"
                class="lg:hidden flex items-center justify-center w-10 h-10 rounded-lg hover:bg-slate-100 transition">

                <i class="bi bi-list text-2xl text-slate-700"></i>

            </button>

            <div>

                <h1 class="text-2xl font-bold text-slate-800">
                    @yield('title', 'Dashboard')
                </h1>

                <p class="text-sm text-slate-500">
                    {{ now()->translatedFormat('l, d F Y') }}
                </p>

            </div>

        </div>

        {{-- Right --}}
        <div class="flex items-center gap-5">

           
            

            {{-- Notification --}}
         {{-- <button
                class="relative flex items-center justify-center w-11 h-11 rounded-xl hover:bg-slate-100 transition">

                <i class="bi bi-bell text-xl text-slate-600"></i>

                <span
                    class="absolute top-2 right-2 w-2.5 h-2.5 rounded-full bg-red-500">
                </span>

            </button> --}}

            {{-- User --}}
            <div class="relative group">

                <button
                    class="flex items-center gap-3 rounded-xl border border-slate-200 bg-white px-3 py-2 hover:bg-slate-50 transition">

                    <div
                        class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 text-white font-bold">

                        {{ strtoupper(substr(Auth::user()->name ?? 'A',0,1)) }}

                    </div>

                    <div class="hidden md:block text-left">

                        <p class="text-sm font-semibold text-slate-800">

                            {{ Auth::user()->name }}

                        </p>

                        <p class="text-xs text-slate-500">

                            Administrator

                        </p>

                    </div>

                    <i class="bi bi-chevron-down text-slate-500"></i>

                </button>

                {{-- Dropdown --}}
                <div
                    class="absolute right-0 mt-2 hidden w-56 rounded-xl border border-slate-200 bg-white shadow-lg group-hover:block">

                    <div class="border-b border-slate-100 px-5 py-4">

                        <p class="font-semibold text-slate-800">

                            {{ Auth::user()->name }}

                        </p>

                        <p class="text-sm text-slate-500">

                            {{ Auth::user()->email }}

                        </p>

                    </div>

                    {{-- <div class="py-2">

                        <a
                            href="profile"
                            class="flex items-center gap-3 px-5 py-3 hover:bg-slate-100 transition">

                            <i class="bi bi-person-circle"></i>

                            Profile

                        </a>

                       

                    </div> --}}

                    <div class="border-t border-slate-100">

                        <form method="POST" action="{{ route('logout') }}">

                            @csrf

                            <button
                                class="flex w-full items-center gap-3 px-5 py-3 text-red-600 hover:bg-red-50 transition">

                                <i class="bi bi-box-arrow-right"></i>

                                Logout

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</header>

{{-- Sidebar Mobile --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const sidebar = document.getElementById('sidebar');

    const backdrop = document.getElementById('sidebarBackdrop');

    const toggle = document.getElementById('sidebarToggle');

    if(toggle){

        toggle.addEventListener('click', function(){

            sidebar.classList.toggle('-translate-x-full');

            backdrop.classList.toggle('hidden');

        });

    }

    if(backdrop){

        backdrop.addEventListener('click', function(){

            sidebar.classList.add('-translate-x-full');

            backdrop.classList.add('hidden');

        });

    }

});

</script>