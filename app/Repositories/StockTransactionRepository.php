<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\StockTransaction;
use App\Interfaces\StockTransactionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class StockTransactionRepository implements StockTransactionRepositoryInterface
{

    public function getAll()
    {
        return StockTransaction::with('product')
            ->latest()
            ->paginate(10);
    }


    public function getById($id)
    {
        return StockTransaction::findOrFail($id);
    }


    public function store(array $data)
{
    return DB::transaction(function () use ($data) {

        $product = Product::findOrFail($data['product_id']);

        // Cek stok jika transaksi OUT
        if (
            $data['type'] == 'OUT' &&
            $product->stock < $data['quantity']
        ) {
            throw new \Exception('Stok produk tidak mencukupi.');
        }

        $transaction = StockTransaction::create($data);

        if ($data['type'] == 'IN') {
            $product->increment('stock', $data['quantity']);
        } else {
            $product->decrement('stock', $data['quantity']);
        }

        return $transaction;
    });
}


    public function update($id, array $data)
{
    return DB::transaction(function () use ($id, $data) {

        $transaction = StockTransaction::findOrFail($id);

        $product = Product::findOrFail($transaction->product_id);

        // Kembalikan stok lama
        if ($transaction->type == 'IN') {
            $product->decrement('stock', $transaction->quantity);
        } else {
            $product->increment('stock', $transaction->quantity);
        }

        $transaction->update($data);

        $product = Product::findOrFail($transaction->product_id);

        // Terapkan stok baru
        if ($transaction->type == 'IN') {
            $product->increment('stock', $transaction->quantity);
        } else {
            $product->decrement('stock', $transaction->quantity);
        }

        return $transaction;
    });
}


   public function delete($id)
{
    return DB::transaction(function () use ($id) {

        $transaction = StockTransaction::findOrFail($id);

        $product = Product::findOrFail($transaction->product_id);

        if ($transaction->type == 'IN') {
            $product->decrement('stock', $transaction->quantity);
        } else {
            $product->increment('stock', $transaction->quantity);
        }

        return $transaction->delete();
    });
}

}