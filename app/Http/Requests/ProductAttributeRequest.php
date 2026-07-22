<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'product_id'      => 'required|exists:products,id',
            'attribute_name'  => 'required|string|max:255',
            'attribute_value' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required'      => 'Produk wajib dipilih.',
            'product_id.exists'        => 'Produk tidak ditemukan.',

            'attribute_name.required' => 'Nama atribut wajib diisi.',
            'attribute_name.max'      => 'Nama atribut maksimal 255 karakter.',

            'attribute_value.required' => 'Nilai atribut wajib diisi.',
            'attribute_value.max'      => 'Nilai atribut maksimal 255 karakter.',
        ];
    }
}