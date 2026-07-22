<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{


    public function authorize(): bool
    {
        return true;
    }




    public function rules(): array
    {

        return [


            'name' => [

                'required',

                'string',

                'max:255',

            ],



            'email' => [

                'required',

                'email',

                Rule::unique('users','email')
                    ->ignore(
                        $this->route('user')
                    ),

            ],




            'password' => [

                $this->isMethod('POST')
                    ? 'required'
                    : 'nullable',


                'min:8',


                'confirmed',

            ],




            'role' => [

                'required',


                Rule::exists('roles','name')
                    ->where(function($query){

                        $query->where(
                            'guard_name',
                            'web'
                        );

                    }),

            ],


        ];

    }







    public function messages(): array
    {

        return [


            'name.required'
                => 'Nama user wajib diisi.',



            'email.required'
                => 'Email wajib diisi.',



            'email.email'
                => 'Format email tidak valid.',



            'email.unique'
                => 'Email sudah digunakan.',




            'password.required'
                => 'Password wajib diisi.',



            'password.min'
                => 'Password minimal 8 karakter.',



            'password.confirmed'
                => 'Konfirmasi password tidak sama.',




            'role.required'
                => 'Role wajib dipilih.',



            'role.exists'
                => 'Role tidak tersedia.',


        ];

    }


}