@extends('layouts.app')

@section('title', 'Approval Transaction')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">

                Approval Transaction

            </h1>

            <p class="mt-1 text-slate-500">

                Konfirmasi transaksi dari Manager.

            </p>

        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div
            class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-700">

            {{ session('success') }}

            @if(session('error'))

    <div class="mb-6 rounded-lg bg-red-100 px-4 py-3 text-red-700">

        {{ session('error') }}

    </div>

@endif

        </div>

    @endif



    {{-- ====================== STOCK IN ====================== --}}

    <div
        class="mb-8 overflow-hidden rounded-xl bg-white shadow">

        <div
            class="flex items-center justify-between border-b px-6 py-4">

            <h2
                class="text-lg font-semibold text-slate-700">

                Pending Stock In

            </h2>

            <span
                class="rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-700">

                {{ $stockIns->count() }} Pending

            </span>

        </div>



        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-6 py-4 text-left">

                            No

                        </th>

                        <th class="px-6 py-4 text-left">

                            Tanggal

                        </th>

                        <th class="px-6 py-4 text-left">

                            Produk

                        </th>

                        <th class="px-6 py-4 text-left">

                            Qty

                        </th>

                        <th class="px-6 py-4 text-left">

                            Catatan

                        </th>

                        <th class="px-6 py-4 text-center">

                            Action

                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($stockIns as $item)

                        <tr
                            class="border-t hover:bg-slate-50">

                            <td class="px-6 py-4">

                                {{ $loop->iteration }}

                            </td>

                            <td class="px-6 py-4">

                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}

                            </td>

                            <td class="px-6 py-4 font-medium">

                                {{ $item->product->name }}

                            </td>

                            <td
                                class="px-6 py-4 font-semibold text-green-600">

                                +{{ $item->qty }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $item->note ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                <div
                                    class="flex justify-center gap-2">

                                    {{-- APPROVE --}}

                                    <form
                                        action="{{ route('approvals.stockin.approve',$item->id) }}"
                                        method="POST">

                                        @csrf

                                        <button
                                            onclick="return confirm('Approve transaksi ini?')"
                                            class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">

                                            <i class="bi bi-check-circle"></i>

                                            Approve

                                        </button>

                                    </form>



                                    {{-- REJECT --}}

                                    <button
                                        type="button"
                                        onclick="openRejectModal('stock-in',{{ $item->id }})"
                                        class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">

                                        <i class="bi bi-x-circle"></i>

                                        Reject

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-8 text-center text-slate-500">

                                Tidak ada transaksi Stock In yang menunggu approval.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

        {{-- ====================== STOCK OUT ====================== --}}

    <div class="overflow-hidden rounded-xl bg-white shadow">

        <div
            class="flex items-center justify-between border-b px-6 py-4">

            <h2
                class="text-lg font-semibold text-slate-700">

                Pending Stock Out

            </h2>

            <span
                class="rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-700">

                {{ $stockOuts->count() }} Pending

            </span>

        </div>



        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-slate-100">

                    <tr>

                        <th class="px-6 py-4 text-left">
                            No
                        </th>

                        <th class="px-6 py-4 text-left">
                            Tanggal
                        </th>

                        <th class="px-6 py-4 text-left">
                            Produk
                        </th>

                        <th class="px-6 py-4 text-left">
                            Qty
                        </th>

                        <th class="px-6 py-4 text-left">
                            Catatan
                        </th>

                        <th class="px-6 py-4 text-center">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($stockOuts as $item)

                        <tr class="border-t hover:bg-slate-50">

                            <td class="px-6 py-4">

                                {{ $loop->iteration }}

                            </td>

                            <td class="px-6 py-4">

                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}

                            </td>

                            <td class="px-6 py-4 font-medium">

                                {{ $item->product->name }}

                            </td>

                            <td
                                class="px-6 py-4 font-semibold text-red-600">

                                -{{ $item->qty }}

                            </td>

                            <td class="px-6 py-4">

                                {{ $item->note ?? '-' }}

                            </td>

                            <td class="px-6 py-4">

                                <div
                                    class="flex justify-center gap-2">

                                    {{-- APPROVE --}}

                                    <form
                                        action="{{ route('approvals.stockout.approve',$item->id) }}"
                                        method="POST">

                                        @csrf

                                        <button
                                            onclick="return confirm('Approve transaksi ini?')"
                                            class="rounded-lg bg-green-600 px-4 py-2 text-white hover:bg-green-700">

                                            <i class="bi bi-check-circle"></i>

                                            Approve

                                        </button>

                                    </form>

                                    {{-- REJECT --}}

                                    <button
                                        type="button"
                                        onclick="openRejectModal('stock-out',{{ $item->id }})"
                                        class="rounded-lg bg-red-600 px-4 py-2 text-white hover:bg-red-700">

                                        <i class="bi bi-x-circle"></i>

                                        Reject

                                    </button>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-8 text-center text-slate-500">

                                Tidak ada transaksi Stock Out yang menunggu approval.

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- ====================== MODAL REJECT ====================== --}}

<div
    id="rejectModal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">

    <div
        class="w-full max-w-lg rounded-xl bg-white shadow-xl">

        <form
            id="rejectForm"
            method="POST">

            @csrf

            <div
                class="border-b px-6 py-4">

                <h2
                    class="text-lg font-semibold text-slate-700">

                    Reject Transaction

                </h2>

            </div>



            <div class="p-6">

                <label
                    class="mb-2 block font-medium text-slate-700">

                    Alasan Penolakan

                </label>

                <textarea
                    name="reason"
                    rows="5"
                    required
                    class="w-full rounded-xl border-slate-300 focus:border-red-500 focus:ring-red-500"
                    placeholder="Masukkan alasan penolakan..."></textarea>

            </div>



            <div
                class="flex justify-end gap-3 border-t px-6 py-4">

                <button
                    type="button"
                    onclick="closeRejectModal()"
                    class="rounded-lg bg-slate-300 px-5 py-2 hover:bg-slate-400">

                    Batal

                </button>

                <button
                    class="rounded-lg bg-red-600 px-5 py-2 text-white hover:bg-red-700">

                    Reject

                </button>

            </div>

        </form>

    </div>

</div>



<script>

function openRejectModal(type,id)
{

    let form=document.getElementById('rejectForm');

    if(type==='stock-in')
    {

        form.action='/approvals/stock-in/'+id+'/reject';

    }
    else
    {

        form.action='/approvals/stock-out/'+id+'/reject';

    }

    document
        .getElementById('rejectModal')
        .classList
        .remove('hidden');

    document
        .getElementById('rejectModal')
        .classList
        .add('flex');

}



function closeRejectModal()
{

    document
        .getElementById('rejectModal')
        .classList
        .remove('flex');

    document
        .getElementById('rejectModal')
        .classList
        .add('hidden');

}

</script>

@endsection