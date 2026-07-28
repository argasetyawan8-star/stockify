<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'description',
        'purchase_price',
        'selling_price',
        'image',
        'minimum_stock',
        'stock',
    ];

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Relasi ke Stock Transaction
     */
    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    /**
     * Relasi ke Product Attribute
     */
    public function attributes()
{
    return $this->hasMany(ProductAttribute::class);
}

    public function stockIns()
{
    return $this->hasMany(StockIn::class);
}
/**
 * Relasi ke Stock Out
 */
public function stockOuts()
{
    return $this->hasMany(StockOut::class);
}

/**
 * Relasi ke Stock Opname
 */
public function stockOpnames()
{
    return $this->hasMany(StockOpname::class);
}

}