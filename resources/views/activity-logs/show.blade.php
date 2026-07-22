@extends('layouts.app')

@section('title','Detail Activity Log')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-8">

        <h2 class="mb-8 text-2xl font-bold">

            Detail Activity Log

        </h2>

        <div class="grid grid-cols-2 gap-6">

            <div>

                <label class="text-sm text-slate-500">

                    User

                </label>

                <p class="font-semibold">

                    {{ $activityLog->user->name }}

                </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">

                    Modul

                </label>

                <p class="font-semibold">

                    {{ $activityLog->module }}

                </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">

                    Waktu

                </label>

                <p class="font-semibold">

                    {{ \Carbon\Carbon::parse($activityLog->created_at)->format('d M Y H:i:s') }}

                </p>

            </div>

            <div>

                <label class="text-sm text-slate-500">

                    IP Address

                </label>

                <p class="font-semibold">

                    {{ $activityLog->ip_address }}

                </p>

            </div>

        </div>

        <div class="mt-8">

            <label class="text-sm text-slate-500">

                Aktivitas

            </label>

            <div class="p-4 mt-2 rounded-xl bg-slate-100">

                {{ $activityLog->activity }}

            </div>

        </div>

        <div class="mt-8">

            <a href="{{ route('activity-logs.index') }}"
                class="px-5 py-3 text-white bg-slate-700 rounded-xl hover:bg-slate-800">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection