<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOutRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }





    public function rules(): array
    {
        return [

            'product_id' => [
                'required',
                'exists:products,id'
            ],


            'qty' => [
                'required',
                'integer',
                'min:1'
            ],


            'date' => [
                'required',
                'date'
            ],


            'reference' => [
                'nullable',
                'string',
                'max:255'
            ],


            'note' => [
                'nullable',
                'string'
            ],

        ];
    }





    public function messages(): array
    {
        return [

            'product_id.required'
                => 'Produk wajib dipilih.',


            'product_id.exists'
                => 'Produk tidak ditemukan.',


            'qty.required'
                => 'Jumlah barang wajib diisi.',


            'qty.integer'
                => 'Jumlah barang harus berupa angka.',


            'qty.min'
                => 'Jumlah barang minimal 1.',


            'date.required'
                => 'Tanggal wajib diisi.',


            'date.date'
                => 'Format tanggal tidak valid.',

        ];
    }

}