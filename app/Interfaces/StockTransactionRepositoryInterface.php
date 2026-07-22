<?php


namespace App\Interfaces;

interface StockTransactionRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function store(array $data);

    public function update($id, array $data);

    public function delete($id);
}