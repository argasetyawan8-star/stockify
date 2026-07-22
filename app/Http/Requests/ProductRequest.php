<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $product = $this->route('product');

        return [
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',

            'name' => 'required|string|max:255',

            'sku' => 'required|string|max:100|unique:products,sku,' . ($product?->id ?? $product),

            'description' => 'nullable|string',

            'purchase_price' => 'required|numeric|min:0',

            'selling_price' => 'required|numeric|min:0',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'minimum_stock' => 'required|integer|min:0',

            'attributes' => 'nullable|array',

            'attributes.*.name' => 'nullable|string|max:255',

            'attributes.*.value' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori wajib dipilih.',
            'supplier_id.required' => 'Supplier wajib dipilih.',

            'name.required' => 'Nama produk wajib diisi.',

            'sku.required' => 'SKU wajib diisi.',
            'sku.unique' => 'SKU sudah digunakan.',

            'purchase_price.required' => 'Harga beli wajib diisi.',
            'selling_price.required' => 'Harga jual wajib diisi.',

            'minimum_stock.required' => 'Minimum stok wajib diisi.',
        ];
    }
}