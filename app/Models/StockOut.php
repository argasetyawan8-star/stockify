<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockOut extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_id',
        'qty',
        'date',
        'reference',
        'note',

        // Approval
        'status',
        'approved_by',
        'approved_at',
        'rejection_reason',
    ];



    protected $casts = [

        'date' => 'date',

        'approved_at' => 'datetime',

    ];



    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    public function approvedBy()
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }
}