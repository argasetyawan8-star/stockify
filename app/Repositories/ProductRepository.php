<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
   public function getAll($search = null)
{
    return Product::with([
            'category',
            'supplier'
        ])

        ->when($search, function ($query) use ($search) {

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', '%' . $search . '%')

                ->orWhere('sku', 'like', '%' . $search . '%')

                ->orWhereHas('category', function ($category) use ($search) {

                    $category->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                })

                ->orWhereHas('supplier', function ($supplier) use ($search) {

                    $supplier->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    );

                });


            });


        })

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