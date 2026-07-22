<?php

namespace App\Services;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\ProductAttribute;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getAll()
    {
        return $this->productRepository->getAll();
    }

    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    
   public function store(array $data)
{
    $attributes = $data['attributes'] ?? [];

    unset($data['attributes']);

    $product = $this->productRepository->store($data);

    foreach ($attributes as $attribute) {

        if (
            !empty($attribute['name']) &&
            !empty($attribute['value'])
        ) {

            $product->attributes()->create([
                'attribute_name'  => $attribute['name'],
                'attribute_value' => $attribute['value'],
            ]);

        }

    }

    return $product;
}

    public function update($id, array $data)
{
    $attributes = $data['attributes'] ?? [];

    unset($data['attributes']);

    $product = $this->productRepository->update($id, $data);

    $product->attributes()->delete();

    foreach ($attributes as $attribute) {

        if (
            !empty($attribute['name']) &&
            !empty($attribute['value'])
        ) {

            $product->attributes()->create([
                'attribute_name'  => $attribute['name'],
                'attribute_value' => $attribute['value'],
            ]);

        }

    }

    return $product;
}

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function getAllData()
{
    return $this->productRepository->getAllData();
}

public function lowStock()
{
    return $this->productRepository->lowStock();
}



}