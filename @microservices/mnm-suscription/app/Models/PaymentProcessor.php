<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProcessor extends Model
{
    protected $table='payment_processor';
    protected $fillable=[
        'payment_processor_id',
        'uuid',
        'description',
        'payment_method',
        'status'
    ];
    protected $primaryKey='id';
    protected $hidden=[
        'created_at','updated_at','deleted_at'
    ];
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }
}
