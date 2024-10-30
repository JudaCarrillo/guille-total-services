<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    protected $table='users';
    protected $fillable = [
        'user_id',
        'name',
        'paternal_surname',
        'maternal_surname',
        'data_of_birth',
        'password',
        'user_type',
        'verified_state',
        'verified_at',
        'status'
    ];
    protected $primaryKey='id';

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
