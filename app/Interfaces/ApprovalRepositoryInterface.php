<?php

namespace App\Interfaces;

interface ApprovalRepositoryInterface
{

    public function getPendingStockIns();

    public function getPendingStockOuts();

    public function findStockIn($id);

    public function findStockOut($id);

    public function updateStockIn($id, array $data);

    public function updateStockOut($id, array $data);

}