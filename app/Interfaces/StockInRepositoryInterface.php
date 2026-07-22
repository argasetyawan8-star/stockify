<?php

namespace App\Interfaces;


interface StockInRepositoryInterface
{

    public function getAll($search = null);


    public function getById($id);


    public function store(array $data);


    public function update($id,array $data);


    public function delete($id);

}