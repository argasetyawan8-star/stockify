<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockOpnameRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'physical_stock' => 'required|integer|min:0',
            'notes' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists' => 'Produk tidak ditemukan.',

            'physical_stock.required' => 'Stok fisik wajib diisi.',
            'physical_stock.integer' => 'Stok fisik harus berupa angka.',
            'physical_stock.min' => 'Stok fisik minimal 0.',

            'notes.max' => 'Catatan maksimal 500 karakter.',
        ];
    }
}