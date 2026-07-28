<?php

namespace App\Interfaces;

interface SettingRepositoryInterface
{
    public function first();

    public function update($id, array $data);
}