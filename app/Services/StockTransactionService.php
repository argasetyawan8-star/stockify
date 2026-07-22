<?php

namespace App\Services;

use App\Interfaces\StockTransactionRepositoryInterface;

class StockTransactionService
{
    protected $stockTransactionRepository;


    public function __construct(
        StockTransactionRepositoryInterface $stockTransactionRepository
    ) {
        $this->stockTransactionRepository = $stockTransactionRepository;
    }


    public function getAll()
    {
        return $this->stockTransactionRepository->getAll();
    }


    public function getById($id)
    {
        return $this->stockTransactionRepository->getById($id);
    }


    public function store(array $data)
    {
        return $this->stockTransactionRepository->store($data);
    }


    public function update($id, array $data)
    {
        return $this->stockTransactionRepository->update($id, $data);
    }


    public function delete($id)
    {
        return $this->stockTransactionRepository->delete($id);
    }
}