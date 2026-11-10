<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Otomatis hash password sebelum disimpan.
     */
    public function setPasswordAttribute($value): void
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * Activity Logs
     */
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function approvedStockIns()
    {
        return $this->hasMany(
            StockIn::class,
            'approved_by'
        );
    }

    public function approvedStockOuts()
    {
        return $this->hasMany(
            StockOut::class,
            'approved_by'
        );
    }
}
