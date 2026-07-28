<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [

        'app_name',
        'company_name',
        'email',
        'phone',
        'address',
        'website',
        'description',
        'logo',
        'favicon',
        'default_pagination',
        'minimum_stock',
        'timezone',
        'currency',
        'footer',

    ];
}