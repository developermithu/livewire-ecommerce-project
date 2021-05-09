<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Factory
        // Category::factory(10)->create();
        // Product::factory(30)->create();

        // Seeder
        $this->call(UserSeeder::class);
    }
}
