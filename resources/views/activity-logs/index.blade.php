@extends('layouts.app')

@section('title', 'Activity Log')

@section('content')

<div class="flex items-center justify-between mb-6">

    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Activity Log
        </h1>

        <p class="mt-1 text-slate-500">
            Riwayat aktivitas seluruh pengguna pada sistem Stockify.
        </p>
    </div>

</div>

<div class="overflow-hidden bg-white border border-slate-200 rounded-2xl shadow-sm">

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left">No</th>

                    <th class="px-6 py-4 text-left">Waktu</th>

                    <th class="px-6 py-4 text-left">User</th>

                    <th class="px-6 py-4 text-center">Modul</th>

                    <th class="px-6 py-4 text-left">Aktivitas</th>

                    <th class="px-6 py-4 text-center">IP</th>

                    <th class="px-6 py-4 text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($activityLogs as $log)

                <tr class="border-t hover:bg-slate-50">

                    <td class="px-6 py-4">
                        {{ $loop->iteration + ($activityLogs->firstItem() - 1) }}
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y H:i') }}
                    </td>

                    <td class="px-6 py-4">

                        <div class="flex items-center gap-3">

                            <div class="flex items-center justify-center w-10 h-10 font-bold text-white bg-blue-600 rounded-full">

                                {{ strtoupper(substr($log->user->name,0,1)) }}

                            </div>

                            <div>

                                <div class="font-semibold">

                                    {{ $log->user->name }}

                                </div>

                                <div class="text-sm text-slate-500">

                                    {{ $log->user->email }}

                                </div>

                            </div>

                        </div>

                    </td>

                    <td class="px-6 py-4 text-center">

                        @php

                            $colors = [
                                'Product'=>'bg-blue-100 text-blue-700',
                                'Category'=>'bg-green-100 text-green-700',
                                'Supplier'=>'bg-yellow-100 text-yellow-700',
                                'User'=>'bg-purple-100 text-purple-700',
                                'Stock In'=>'bg-emerald-100 text-emerald-700',
                                'Stock Out'=>'bg-red-100 text-red-700',
                                'Stock Opname'=>'bg-indigo-100 text-indigo-700',
                            ];

                        @endphp

                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $colors[$log->module] ?? 'bg-gray-100 text-gray-700' }}">

                            {{ $log->module }}

                        </span>

                    </td>

                    <td class="px-6 py-4">

                        {{ $log->activity }}

                    </td>

                    <td class="px-6 py-4 text-center">

                        {{ $log->ip_address }}

                    </td>

                    <td class="px-6 py-4">

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('activity-logs.show',$log->id) }}"
                                class="px-3 py-2 text-white bg-sky-500 rounded-lg hover:bg-sky-600">

                                <i class="bi bi-eye"></i>

                            </a>

                            <form action="{{ route('activity-logs.destroy',$log->id) }}"
                                method="POST"
                                onsubmit="return confirm('Hapus activity log ini?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="px-3 py-2 text-white bg-red-500 rounded-lg hover:bg-red-600">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="7"
                        class="py-10 text-center text-slate-500">

                        Belum ada Activity Log.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

<div class="mt-6">

    {{ $activityLogs->links() }}

</div>

@endsection