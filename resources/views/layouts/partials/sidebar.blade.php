@php
    use Illuminate\Support\Facades\Auth;
@endphp

<aside id="sidebar"
    class="
    fixed
    top-0
    left-0
    z-20
    w-64
    h-screen
    transition-transform
    bg-gradient-to-b
    from-purple-950
    via-purple-900
    to-blue-950
    border-r
    border-white/10
    lg:translate-x-0
    "
    aria-label="Sidebar">

    <div class="flex flex-col h-full">

        {{-- ================= LOGO ================= --}}
<div 
class="
flex
items-center
px-5
py-4
border-b
border-white/10
">


    @if($setting && $setting->logo)


        <div class="flex items-center justify-center w-12 h-12 rounded-xl overflow-hidden bg-white shadow-lg">

            <img
                src="{{ asset('storage/'.$setting->logo) }}"
                class="w-full h-full object-cover"
                alt="Logo Stockify">

        </div>


    @else


        <div
            class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-purple-500 to-blue-600 shadow-lg">


            <i class="bi bi-box-seam text-white text-2xl"></i>


        </div>


    @endif






    <div class="ml-3">


        <h1 class="text-xl font-bold tracking-wide text-white">

            {{ $setting->app_name ?? 'STOCKIFY' }}

        </h1>



        <p class="text-xs text-purple-200">

            {{ $setting->tagline ?? 'Inventory Management' }}

        </p>


    </div>


</div>

        {{-- ================= MENU ================= --}}
        <div class="flex-1 overflow-y-auto px-4 py-5 custom-scrollbar">

            <ul class="space-y-2">

                {{-- ================= DASHBOARD ================= --}}
                @can('view dashboard')

                <li>

                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('dashboard')
                           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <i class="bi bi-speedometer2"></i>

                        <span>Dashboard</span>

                    </a>

                </li>

                @endcan

                 


                {{-- ================= MASTER DATA ================= --}}
                @canany([
                    'view categories',
                    'view suppliers',
                    'view products',
                    'view users'
                ])

                <li class="pt-5">

                    <p class="px-4 text-xs uppercase tracking-widest text-purple-300">

                        Master Data

                    </p>

                </li>

                @endcanany



                {{-- Categories --}}
                @can('view categories')

                <li>

                    <a href="{{ route('categories.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('categories.*')
                           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <i class="bi bi-tags-fill"></i>

                        <span>Categories</span>

                    </a>

                </li>

                @endcan



                {{-- Suppliers --}}
                @can('view suppliers')

                <li>

                    <a href="{{ route('suppliers.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('suppliers.*')
                            ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <i class="bi bi-truck"></i>

                        <span>Suppliers</span>

                    </a>

                </li>

                @endcan



                {{-- Products --}}
                @can('view products')

                <li>

                    <a href="{{ route('products.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('products.*')
                            ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <i class="bi bi-box-seam"></i>

                        <span>Products</span>

@if($lowStockCount > 0)
    <span
        class="rounded-full bg-yellow-500 px-2 py-0.5 text-xs font-semibold text-white">
        {{ $lowStockCount }}
    </span>
@endif

                    </a>

                </li>

                @endcan



                {{-- User Management --}}
                @can('view users')

                <li>

                    <a href="{{ route('users.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('users.*')
                           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <i class="bi bi-people-fill"></i>

                        <span>User Management</span>

                    </a>

                </li>

                @endcan

                                {{-- ================= TRANSACTIONS ================= --}}
                @canany([
                    'view stock in',
                    'view stock out',
                    'view stock opname'
                ])

                <li class="pt-5">

                    <p class="px-4 text-xs uppercase tracking-widest text-purple-300">

                        Transactions

                    </p>

                </li>

                @endcanany



                {{-- Stock In --}}
                @can('view stock in')

                <li>

                    <a href="{{ route('stock-ins.index') }}"
                        class="flex items-center justify-between px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('stock-ins.*')
                           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <div class="flex items-center gap-3">

                            <i class="bi bi-box-arrow-in-down"></i>

                            <span>Stock In</span>

                        </div>

                    </a>

                </li>

                @endcan



                {{-- Stock Out --}}
                @can('view stock out')

                <li>

                    <a href="{{ route('stock-outs.index') }}"
                        class="flex items-center justify-between px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('stock-outs.*')
                            ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <div class="flex items-center gap-3">

                            <i class="bi bi-box-arrow-up"></i>

                            <span>Stock Out</span>

                        </div>

                    </a>

                </li>

                @endcan



                {{-- Stock Opname --}}
                @can('view stock opname')

                <li>

                    <a href="{{ route('stock-opnames.index') }}"
                        class="flex items-center justify-between px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('stock-opnames.*')
                           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <div class="flex items-center gap-3">

                            <i class="bi bi-clipboard-check"></i>

                            <span>Stock Opname</span>

                        </div>

                    </a>

                </li>

                @endcan





                {{-- ================= APPROVAL ================= --}}
                @role('Staff Gudang')
<li>
    <a href="{{ route('approvals.index') }}"
        class="flex items-center justify-between px-4 py-3 rounded-xl transition
        {{ request()->routeIs('approvals.*')
           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

        <div class="flex items-center gap-3">
            <i class="bi bi-patch-check-fill"></i>
            <span>Approval</span>
        </div>

        @if($pendingApproval > 0)
            <span
                class="rounded-full bg-red-500 px-2 py-0.5 text-xs font-semibold text-white">
                {{ $pendingApproval }}
            </span>
        @endif

    </a>
</li>
@endrole





                {{-- ================= REPORTS ================= --}}
                @can('view reports')

                <li class="pt-5">

                    <p class="px-4 text-xs uppercase tracking-widest text-purple-300">

                        Reports

                    </p>

                </li>

                <li>

                    <a href="{{ route('reports.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('reports.*')
                           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <i class="bi bi-file-earmark-bar-graph"></i>

                        <span>Reports</span>

                    </a>

                </li>

                @endcan



                {{-- ================= SETTINGS ================= --}}

@can('view settings')

<li class="pt-5">

    <p class="px-4 text-xs uppercase tracking-widest text-purple-300">
        Configuration
    </p>

</li>


<li>

    <a href="{{ route('settings.index') }}"
        class="flex items-center justify-between px-4 py-3 rounded-xl transition
        {{ request()->routeIs('settings.*')
           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

        <div class="flex items-center gap-3">

            <i class="bi bi-gear-fill"></i>

            <span>
                Settings
            </span>

        </div>

    </a>

</li>

@endcan

                {{-- ================= SYSTEM ================= --}}
                @can('view activity logs')

                <li class="pt-5">

                    <p class="px-4 text-xs uppercase tracking-widest text-purple-300">

                        System

                    </p>

                </li>

                <li>

                    <a href="{{ route('activity-logs.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition
                        {{ request()->routeIs('activity-logs.*')
                           ? 'bg-white/20 backdrop-blur text-white shadow-lg'
                            : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">

                        <i class="bi bi-clock-history"></i>

                        <span>Activity Logs</span>

                    </a>

                </li>

                @endcan

            </ul>

        </div>



       {{-- PROFILE --}}
<div class="border-t border-white/10">

    <a href="{{ route('profile.edit') }}"
        class="block rounded-xl bg-white/10 backdrop-blur p-3 transition hover:bg-slate-700">

        <div class="flex items-center gap-3">

            {{-- Avatar --}}
            <div
                class="flex h-11 w-11 items-center justify-center rounded-full bg-gradient-to-br from-purple-500 to-blue-600 text-white font-bold">

                {{ strtoupper(substr(Auth::user()->name,0,1)) }}

            </div>


            {{-- User Info --}}
            <div class="min-w-0 flex-1">

                <h4 class="truncate text-sm font-semibold text-white">
                    {{ Auth::user()->name }}
                </h4>


                <p class="truncate text-xs text-slate-400">

                    {{ Auth::user()->getRoleNames()->first() }}

                </p>

            </div>


            {{-- Icon --}}
            <i class="bi bi-chevron-right text-slate-400"></i>


        </div>


    </a>

</div>

    </div>

</aside>

{{-- ================= MOBILE BACKDROP ================= --}}
<div
    id="sidebarBackdrop"
    class="fixed inset-0 z-10 hidden bg-black/50 lg:hidden">
</div>