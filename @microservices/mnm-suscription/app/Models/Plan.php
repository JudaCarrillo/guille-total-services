<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table='plan';
    protected $fillable=[
        'plan_id',
        'description',
        'price',
        'status'
        
    ];
    protected $primaryKey='id';
    protected $hidden=[
        'created_at','updated_at','deleted_at'
    ];
    public function membership(){
        return $this->hasMany(Membership::class);
    }
}