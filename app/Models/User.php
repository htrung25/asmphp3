<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;
    // THÊM DÒNG NÀY VÀO SAU CÁC USE KHÁC

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function cast()
    {
        return [
            'email_verified_at' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
}