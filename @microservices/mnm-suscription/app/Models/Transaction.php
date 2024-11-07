<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table='transaction';
    protected $fillable=[
        'transaction_id',
        'membership_id',
        'uuid',
        'amount',
        'reference',
        'payment_processor_id',
        'status'
    ];
    protected $primaryKey='id';
    protected $hidden=[
        'created_at','updated_at','deleted_at'
    ];
    public function membership(){
        return $this->belongsTo(Membership::class);
    }
    public function paymentProcessor(){
        return $this->belongsTo(PaymentProcessor::class);
    }
}

