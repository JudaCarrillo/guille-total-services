<?php

namespace App\Http\Controllers;

use App\Models\PaymentProcessor;
use App\Models\Plan;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Service\PaypalClient;

class SuscripcionController extends Controller
{
    private $PaypalClient;

    public function __construct(PaypalClient $PaypalClient)
    {
        $this->PaypalClient = $PaypalClient;
    }

    public function create()
    {
        $product = [
            "name" => "GUILLE TOTAL",
            "type" => "PHYSICAL",
            "description" => "Cotton XL",
            "category" => "CLOTHING",
            "image_url" => "https://example.com/gallary/images/" . ".jpg",
            "home_url" => "https://example.com/catalog/" . ".jpg"
        ];

        try {
            $response = $this->PaypalClient->createProduct($product);

            Producto::create([
                'product_id' => Producto::max('product_id') + 1,
                'uuid' => $response['id']
            ]);

            return $response;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getAll()
    {
        try {
            $products = $this->PaypalClient->getAllProducts();

            if (empty($products)) {
                return response()->json(['error' => 'No products found'], 404);
            }

            return response()->json($products);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function createPlan()
    {
        $product = Producto::where('product_id', 1)->first();
        
        $plan = [
            "product_id" => $product->uuid,
            "name" => "Premium",
            "description" => "visualizar a detalle los resultados, de una manera más precisa, con un modelo más preciso",
            "status" => "ACTIVE",
            "billing_cycles" => [
                [
                    "frequency" => [
                        "interval_unit" => "MONTH",
                        "interval_count" => 1
                    ],
                    "tenure_type" => "REGULAR",
                    "sequence" => 1,
                    "total_cycles" => 1,
                    "pricing_scheme" => [
                        "fixed_price" => [
                            "value" => "3",
                            "currency_code" => "USD"
                        ]
                    ]
                ]
            ],
            "payment_preferences" => [
                "auto_bill_outstanding" => true,
                "setup_fee" => [
                    "value" => "0",
                    "currency_code" => "USD"
                ],
                "payment_failure_threshold" => 3
            ],
            "taxes" => [
                "percentage" => 0,
                "inclusive" => false
            ]
        ];

        try {

            return $this->PaypalClient->createPlan($plan);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getAllPlans()
    {
        try {
            $plans = $this->PaypalClient->getAllPlans();
            if (empty($plans)) {
                return response()->json(['error' => 'No plans found'], 404);
            }
            return response()->json($plans);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
