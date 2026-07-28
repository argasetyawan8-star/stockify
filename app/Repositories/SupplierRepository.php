<?php

namespace App\Repositories;

use App\Interfaces\SupplierRepositoryInterface;
use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{
    public function getAll($search = null)
{
    return Supplier::when($search, function ($query) use ($search) {

        $query->where(function ($q) use ($search) {

            $q->where('name', 'like', '%' . $search . '%')

            ->orWhere('email', 'like', '%' . $search . '%')

            ->orWhere('phone', 'like', '%' . $search . '%')

            ->orWhere('address', 'like', '%' . $search . '%');

        });

    })

    ->latest()
    ->paginate(10);
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