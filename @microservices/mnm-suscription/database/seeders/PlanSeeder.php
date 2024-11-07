<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $planes=[
            [
                'plan_id'=>1,
                'description'=>'Free',
                'price'=>0,
            ],
            [
                'plan_id'=>2,
                'description'=>'Premium',
                'price'=>3,
            ]
        ];
        foreach($planes as $plane){
            Plan::create($plane);
        }
    }
}
