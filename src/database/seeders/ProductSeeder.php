<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch all categories from the database
        $categories = Category::all();

        // Fetch all vendors to associate products with them
        $vendors = Vendor::all();

        foreach ($vendors as $vendor) {
            for ($i = 1; $i <= 10; $i++) {
                Product::create([
                    'vendor_id' => $vendor->id,
                    'name' => 'Product ' . $i,
                    'description' => 'Description for product ' . $i,
                    // Random category from the database
                    'category' => $categories->random()->id,
                    'price' => rand(100000, 5000000) / 100,
                    'stock' => rand(10, 100),
                    'image' => 'product' . $i . '.jpg',
                    'weight' => rand(100, 500) / 10, // Weight in kg
                    'brand' => 'Brand ' . chr(65 + $i), // A, B, C, etc.
                    'status' => collect(['publish', 'draft'])->random(),
                ]);
            }
        }
    }
}
