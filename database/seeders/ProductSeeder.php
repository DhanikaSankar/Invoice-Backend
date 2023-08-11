<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => "Apple iphone",
            'price' => 100000,
        ]);

        Product::create([
            'name' => "Mouse",
            'price' => 500,
        ]);

        Product::create([
            'name' => "Laptop",
            'price' => 150000,
        ]);

        Product::create([
            'name' => "Speaker",
            'price' => 50000,
        ]);

        Product::create([
            'name' => "Canon",
            'price' => 125000,
        ]);
    }
}
