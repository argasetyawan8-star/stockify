<?php

namespace App\Services;

use App\Interfaces\StockOpnameRepositoryInterface;

class StockOpnameService
{
    protected $stockOpnameRepository;

    public function __construct(
        StockOpnameRepositoryInterface $stockOpnameRepository
    ) {
        $this->stockOpnameRepository = $stockOpnameRepository;
    }

    public function getAll()
    {
        return $this->stockOpnameRepository->getAll();
    }

    public function getById($id)
    {
        return $this->stockOpnameRepository->getById($id);
    }

    public function store(array $data)
    {
        return $this->stockOpnameRepository->store($data);
    }

    public function delete($id)
    {
        return $this->stockOpnameRepository->delete($id);
    }
}