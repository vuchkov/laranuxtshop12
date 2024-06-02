<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Option 1: Using Factory (recommended)
        Product::factory(10)->create();

        // Option 2: Direct insertion
        /*Product::create([
            'sku' => 'ABC123',
            'name' => 'Product 1',
            'description' => 'This is a description for product 1.',
            'unit_price' => 19.99,
            'category_id' => 1, // If using categories
        ]);*/
    }
}
