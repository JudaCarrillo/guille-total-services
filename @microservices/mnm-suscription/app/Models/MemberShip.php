<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberShip extends Model
{
    protected $table='membership';
    protected $fillable=[
        'membership_id',
        'uuid',
        'plan_id',
        'user_id',
        'start_date',
        'end_date',
        'status'
    ];
    protected $primaryKey='id';
    protected $hidden=[
        'created_at','updated_at','deleted_at'
    ];
    public function plan(){
        return $this->belongsTo(Plan::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
