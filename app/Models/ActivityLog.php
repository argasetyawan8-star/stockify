<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{

    protected $fillable = [

        'user_id',
        'module',
        'activity',
        'ip_address'

    ];


    public $timestamps = false;



    protected $casts = [

        'created_at' => 'datetime',

    ];



    public function user()
    {

        return $this->belongsTo(User::class);

    }

}