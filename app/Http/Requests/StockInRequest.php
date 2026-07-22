<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
            'reference' => 'nullable|string|max:255',
            'note' => 'nullable|string',
        ];
    }
}