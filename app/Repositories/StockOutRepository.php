<?php

namespace App\Repositories;

use App\Models\StockOut;
use App\Interfaces\StockOutRepositoryInterface;

class StockOutRepository implements StockOutRepositoryInterface
{
    public function getAll($search = null)
    {
        return StockOut::with('product')
            ->when($search, function ($query) use ($search) {

                $query->whereHas('product', function ($q) use ($search) {

                    $q->where('name', 'like', '%' . $search . '%');

                });

            })
            ->latest()
            ->paginate(10);
    }

    public function getById($id)
    {
        return StockOut::with('product')
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        return StockOut::create($data);
    }

    public function update($id, array $data)
    {
        $stockOut = $this->getById($id);

        $stockOut->update($data);

        return $stockOut;
    }

    public function delete($id)
    {
        $stockOut = $this->getById($id);

        return $stockOut->delete();
    }
}