<?php

namespace App\Http\Controllers;

use App\Models\PaymentProcessor;
use Illuminate\Http\Request;

class SuscripcionController extends Controller
{
    public function index()
    {
        PaymentProcessor::all();
        return response()->json(['data' => PaymentProcessor::all()]);
    }
    public function suscripcion() {
        
    }
}
