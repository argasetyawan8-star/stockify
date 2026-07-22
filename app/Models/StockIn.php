<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockIn extends Model
{
    use HasFactory;


    protected $fillable = [
    'product_id',
    'qty',
    'date',
    'reference',
    'note',
    'status',
    'approved_by',
    'approved_at',
    'rejection_reason',
];


    protected $casts = [
        'approved_at' => 'datetime',
        'date' => 'date',
    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    
}