<?php

namespace Database\Seeders;

use App\Models\PaymentProcessor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentProcessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Procesadores=[
            [
                'payment_processor_id' => 1,
                'description' => 'Paypal',
                'payment_method' => json_encode([
                    'PayPal Balance',
                    'Credit/Debit Card',
                    'PayPal Credit',
                    'Bank Transfer',
                    'Digital Wallets'
                ]),
            ],
            [
                'payment_processor_id' => 2,
                'description' => 'Izipay',
                'payment_method' => json_encode([
                    'Credit/Debit Card',
                    'Installments',
                    'QR Payment',
                    'Mobile Wallets',
                    'Bank Transfer'
                ]),
            ]
            
        ];
        foreach($Procesadores as $Procesador){
            PaymentProcessor::create($Procesador);
        }
    }
}
