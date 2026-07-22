@extends('example.layouts.default.dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Stock Transactions</h1>

        <a href="{{ route('stock-transactions.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Tambah Transaksi
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">

        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-4 py-2 text-left">No</th>
                    <th class="border px-4 py-2 text-left">Produk</th>
                    <th class="border px-4 py-2 text-center">Jenis</th>
                    <th class="border px-4 py-2 text-center">Jumlah</th>
                    <th class="border px-4 py-2 text-right">Harga</th>
                    <th class="border px-4 py-2 text-center">Tanggal</th>
                    <th class="border px-4 py-2 text-left">Keterangan</th>
                    <th class="border px-4 py-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($transactions as $transaction)
                    <tr>
                        <td class="border px-4 py-2">
                            {{ $loop->iteration + ($transactions->firstItem() - 1) }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $transaction->product->name ?? '-' }}
                        </td>

                        <td class="border px-4 py-2 text-center">
                            @if($transaction->type == 'IN')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">
                                    IN
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-sm">
                                    OUT
                                </span>
                            @endif
                        </td>

                        <td class="border px-4 py-2 text-center">
                            {{ $transaction->quantity }}
                        </td>

                        <td class="border px-4 py-2 text-right">
                            Rp {{ number_format($transaction->price, 0, ',', '.') }}
                        </td>

                        <td class="border px-4 py-2 text-center">
                            {{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d-m-Y') }}
                        </td>

                        <td class="border px-4 py-2">
                            {{ $transaction->description ?? '-' }}
                        </td>

                        <td class="border px-4 py-2">
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('stock-transactions.edit', $transaction->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm">
                                    Edit
                                </a>

                                <form action="{{ route('stock-transactions.destroy', $transaction->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded text-sm">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="border px-4 py-4 text-center text-gray-500">
                            Belum ada data transaksi.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>

</div>
@endsection