<?php

namespace App\Http\Controllers;


use App\Services\SettingService;
use Illuminate\Http\Request;


class SettingController extends Controller
{

    protected $settingService;



    public function __construct(
        SettingService $settingService
    )
    {
        $this->settingService = $settingService;
    }




    public function index()
    {

        $setting = $this->settingService
            ->getSetting();



        if(!$setting)
        {

            $setting = \App\Models\Setting::create([

                'app_name' => 'Stockify',

                'company_name' => 'Stockify',

                'default_pagination' => 10,

                'minimum_stock' => 5,

                'timezone' => 'Asia/Jakarta',

                'currency' => 'IDR'

            ]);

        }



        return view(
            'settings.index',
            compact('setting')
        );

    }







    public function edit($id)
    {

        $setting = $this->settingService
            ->getSetting();



        return view(
            'settings.edit',
            compact('setting')
        );

    }








    public function update(Request $request, $id)
    {


        $data = $request->validate([


            'app_name' => [
                'required'
            ],


            'company_name' => [
                'nullable'
            ],


            'email' => [
                'nullable',
                'email'
            ],


            'phone' => [
                'nullable'
            ],


            'address' => [
                'nullable'
            ],


            'website' => [
                'nullable'
            ],


            'description' => [
                'nullable'
            ],


            'minimum_stock' => [
                'nullable',
                'integer'
            ],


            'default_pagination' => [
                'nullable',
                'integer'
            ],


            'timezone' => [
                'nullable'
            ],


            'currency' => [
                'nullable'
            ],


            'logo' => [
                'nullable',
                'image',
                'max:2048'
            ],


            'favicon' => [
                'nullable',
                'image',
                'max:1024'
            ]


        ]);






        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        if($request->hasFile('logo'))
        {

            $data['logo'] =
                $request->file('logo')
                ->store('settings','public');

        }






        /*
        |--------------------------------------------------------------------------
        | Upload Favicon
        |--------------------------------------------------------------------------
        */

        if($request->hasFile('favicon'))
        {

            $data['favicon'] =
                $request->file('favicon')
                ->store('settings','public');

        }





        $this->settingService
            ->update($id,$data);





        return redirect()
            ->route('settings.index')
            ->with(
                'success',
                'Pengaturan berhasil diperbarui'
            );


    }


}