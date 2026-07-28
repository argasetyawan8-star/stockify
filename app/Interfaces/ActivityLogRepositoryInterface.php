<?php

namespace App\Interfaces;

interface ActivityLogRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function store(array $data);

    public function delete($id);

    public function latest($limit = 10);
}