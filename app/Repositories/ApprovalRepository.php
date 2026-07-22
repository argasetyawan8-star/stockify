<?php

namespace App\Repositories;

use App\Models\StockIn;
use App\Models\StockOut;
use App\Interfaces\ApprovalRepositoryInterface;


class ApprovalRepository implements ApprovalRepositoryInterface
{


    public function getPendingStockIns()
    {
        return StockIn::with('product')
            ->where('status','pending')
            ->latest()
            ->get();
    }




    public function getPendingStockOuts()
    {
        return StockOut::with('product')
            ->where('status','pending')
            ->latest()
            ->get();
    }





    public function findStockIn($id)
    {
        return StockIn::with('product')
            ->findOrFail($id);
    }





    public function findStockOut($id)
    {
        return StockOut::with('product')
            ->findOrFail($id);
    }





    public function updateStockIn($id, array $data)
    {
        $stockIn = $this->findStockIn($id);

        $stockIn->update($data);

        return $stockIn;
    }





    public function updateStockOut($id, array $data)
    {
        $stockOut = $this->findStockOut($id);

        $stockOut->update($data);

        return $stockOut;
    }


}