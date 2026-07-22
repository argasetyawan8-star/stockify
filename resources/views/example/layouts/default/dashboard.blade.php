@extends('example.layouts.default.baseof')

@section('main')
@vite(['resources/css/app.css','resources/js/app.js'])

<div class="flex overflow-hidden bg-gray-100 min-h-screen">

    {{-- Sidebar --}}
    @include('example.layouts.partials.sidebar')

    {{-- Content --}}
    <div id="main-content" class="flex-1 lg:ml-64">

        <main class="p-6">
            @yield('content')
        </main>

        @include('example.layouts.partials.footer-dashboard')

    </div>

</div>
@endsection