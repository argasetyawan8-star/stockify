<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockTransactionRequest extends FormRequest
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

            'type' => [
                'required',
                'in:IN,OUT,OPNAME'
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],

            'price' => [
                'nullable',
                'numeric',
                'min:0'
            ],

            'transaction_date' => [
                'required',
                'date'
            ],

            'description' => [
                'nullable',
                'string'
            ],

        ];
    }


    public function messages(): array
    {
        return [

            'product_id.required' => 'Produk wajib dipilih.',

            'type.required' => 'Jenis transaksi wajib dipilih.',

            'quantity.required' => 'Jumlah barang wajib diisi.',

            'quantity.min' => 'Jumlah minimal 1.',

            'transaction_date.required' => 'Tanggal transaksi wajib diisi.',

        ];
    }
}