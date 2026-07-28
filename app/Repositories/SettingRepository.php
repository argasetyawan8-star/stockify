<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Interfaces\SettingRepositoryInterface;


class SettingRepository implements SettingRepositoryInterface
{

    public function first()
    {
        return Setting::first();
    }



    public function update($id, array $data)
    {
        $setting = Setting::findOrFail($id);

        $setting->update($data);

        return $setting;
    }

}