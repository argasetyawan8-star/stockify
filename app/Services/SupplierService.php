<?php

namespace App\Services;

use App\Interfaces\SupplierRepositoryInterface;

class SupplierService
{
    protected $repository;

    public function __construct(SupplierRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

   public function getAll($search = null)
{
    return $this->repository->getAll($search);
}

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function store(array $data)
    {
        return $this->repository->store($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

   public function getAllData()
{
    return $this->repository->getAll();
}
}