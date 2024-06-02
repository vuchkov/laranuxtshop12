<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Option 1: Using Factory (recommended)
//        Category::factory(10)->create();

        // Option 2: Direct insertion
        Category::create([
            'name' => 'Home',
        ]);
        Category::create([
            'name' => 'Garden',
        ]);
        Category::create([
            'name' => 'Kitchen',
        ]);
    }
}
