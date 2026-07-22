<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class StoreStockTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:IN,OUT'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0'],
            'transaction_date' => ['required', 'date'],
            'description' => ['nullable', 'string'],
        ];
    }

    protected function passedValidation()
    {
        if ($this->type === 'OUT') {

            $product = Product::find($this->product_id);

            if ($product && $this->quantity > $product->stock) {

                throw ValidationException::withMessages([
                    'quantity' => 'Jumlah stok keluar melebihi stok yang tersedia.',
                ]);
            }
        }
    }
}