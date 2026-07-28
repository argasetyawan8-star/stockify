<?php

namespace App\Services;

use App\Interfaces\SettingRepositoryInterface;

class SettingService
{

    protected $settingRepository;


    public function __construct(
        SettingRepositoryInterface $settingRepository
    )
    {
        $this->settingRepository = $settingRepository;
    }



    public function getSetting()
    {
        return $this->settingRepository->first();
    }




    public function update($id, array $data)
    {
        return $this->settingRepository
            ->update($id, $data);
    }


}