<?php

namespace App\Repositories;

use App\Interfaces\StockInRepositoryInterface;
use App\Models\StockIn;

class StockInRepository implements StockInRepositoryInterface
{
    public function getAll($search = null)
    {
        return StockIn::with('product')
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
        return StockIn::with('product')
            ->findOrFail($id);
    }

    public function store(array $data)
    {
        return StockIn::create($data);
    }

    public function update($id, array $data)
    {
        $stockIn = $this->getById($id);

        $stockIn->update($data);

        return $stockIn;
    }

    public function delete($id)
    {
        $stockIn = $this->getById($id);

        return $stockIn->delete();
    }
}