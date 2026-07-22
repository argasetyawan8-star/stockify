<?php

namespace App\Repositories;

use App\Interfaces\StockOpnameRepositoryInterface;
use App\Models\Product;
use App\Models\StockOpname;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockOpnameRepository implements StockOpnameRepositoryInterface
{
    public function getAll()
    {
        return StockOpname::with(['product', 'user'])
            ->latest()
            ->paginate(10);
    }

    public function getById($id)
    {
        return StockOpname::with(['product', 'user'])
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $product = Product::findOrFail($data['product_id']);

            $systemStock = $product->stock;

            $physicalStock = $data['physical_stock'];

            $difference = $physicalStock - $systemStock;

            $stockOpname = StockOpname::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'system_stock' => $systemStock,
                'physical_stock' => $physicalStock,
                'difference' => $difference,
                'notes' => $data['notes'] ?? null,
            ]);

            $product->update([
                'stock' => $physicalStock,
            ]);

            return $stockOpname;
        });
    }

    public function delete($id)
    {
        return StockOpname::findOrFail($id)->delete();
    }
}