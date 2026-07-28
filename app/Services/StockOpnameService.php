<?php

namespace App\Services;

use App\Interfaces\StockOpnameRepositoryInterface;
use App\Models\Product;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\DB;

class StockOpnameService
{
    protected $stockOpnameRepository;
    protected $activityLogService;

    public function __construct(
        StockOpnameRepositoryInterface $stockOpnameRepository,
        ActivityLogService $activityLogService
    ) {
        $this->stockOpnameRepository = $stockOpnameRepository;
        $this->activityLogService = $activityLogService;
    }

    public function getAll()
    {
        return $this->stockOpnameRepository->getAll();
    }

    public function getById($id)
    {
        return $this->stockOpnameRepository->getById($id);
    }

    /**
     * Simpan Stock Opname
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $stockOpname = $this->stockOpnameRepository->store($data);

            $product = Product::findOrFail($stockOpname->product_id);

            $this->activityLogService->log(
                'Stock Opname',
                'Membuat Stock Opname produk "' .
                $product->name .
                '" (Stok Sistem: ' .
                $stockOpname->system_stock .
                ', Stok Fisik: ' .
                $stockOpname->physical_stock .
                ')'
            );

            return $stockOpname;
        });
    }

    /**
     * Hapus Stock Opname
     */
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {

            $stockOpname = $this->stockOpnameRepository->getById($id);

            $product = Product::findOrFail($stockOpname->product_id);

            $this->activityLogService->log(
                'Stock Opname',
                'Menghapus Stock Opname produk "' .
                $product->name . '"'
            );

            return $this->stockOpnameRepository->delete($id);
        });
    }
}