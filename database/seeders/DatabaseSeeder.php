<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
        ]);

        \App\Models\Product::create([
            'name' => 'Laptop',
            'description' => 'Core i7, 16GB RAM',
            'price' => 1500,
            'stock_quantity' => 10,
        ]);

        \App\Models\Customer::create([
            'name' => 'Nguyen Van A',
            'email' => 'a@example.com',
            'address' => '123 Đường ABC, TP.HCM',
            'phone_number' => '0123456789',
        ]);
    }
}
