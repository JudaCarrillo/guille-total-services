<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate([
            'user_id'=>'1',
            'name'=>'Admin',
            'paternal_surname'=>'Admin',
            'maternal_surname'=>'Admin',
            'data_of_birth'=>'2000-01-01',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('admin'),
            'user_type'=>2,
            'verified_state'=>'V',
            'verified_at'=>now(),
        ]);
    }
}
