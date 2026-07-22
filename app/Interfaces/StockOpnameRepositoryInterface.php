<?php

namespace App\Interfaces;

interface StockOpnameRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function store(array $data);

    public function delete($id);
}