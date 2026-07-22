<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll()
    {
        return Product::with(['category', 'supplier'])
            ->latest()
            ->paginate(10);
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function store(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);

        return $product;
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        return $product->delete();
    }

    public function getAllData()
{
    return Product::latest()->get();
}

    public function lowStock()
{
    return Product::whereColumn('stock', '<=', 'minimum_stock')
        ->latest()
        ->get();
}

}