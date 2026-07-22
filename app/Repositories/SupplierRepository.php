<?php

namespace App\Repositories;

use App\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function getAll()
    {
        return Supplier::latest()->paginate(10);
    }

    public function getById($id)
    {
        return Supplier::findOrFail($id);
    }

    public function store(array $data)
    {
        return Supplier::create($data);
    }

    public function update($id, array $data)
{
    $supplier = Supplier::findOrFail($id);

    $supplier->update($data);

    return $supplier;
}

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function getAllData()
{
    return Supplier::orderBy('name')->get();
}
}