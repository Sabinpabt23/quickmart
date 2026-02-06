<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Get or create categories
        $electronicsId = Category::where('name', 'Electronics')->first()->id;
        $sportsId = Category::where('name', 'Sports')->first()->id;
        $homeId = Category::where('name', 'Home & Kitchen')->first()->id;
        $booksId = Category::where('name', 'Books')->first()->id;
        
        $products = [
            [
                'name' => 'iPhone 15 Pro',
                'description' => 'Latest Apple iPhone with A17 Pro chip',
                'price' => 1299.99,
                'stock' => 50,
                'category_id' => $electronicsId
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'description' => 'Android flagship with advanced camera',
                'price' => 999.99,
                'stock' => 30,
                'category_id' => $electronicsId
            ],
            [
                'name' => 'Nike Air Max',
                'description' => 'Comfortable running shoes',
                'price' => 129.99,
                'stock' => 100,
                'category_id' => $sportsId
            ],
            [
                'name' => 'Kitchen Knife Set',
                'description' => 'Premium stainless steel knives',
                'price' => 89.99,
                'stock' => 40,
                'category_id' => $homeId
            ],
            [
                'name' => 'Harry Potter Book Set',
                'description' => 'Complete Harry Potter collection',
                'price' => 149.99,
                'stock' => 25,
                'category_id' => $booksId
            ],
            [
                'name' => 'Sony Headphones',
                'description' => 'Noise cancelling wireless headphones',
                'price' => 299.99,
                'stock' => 60,
                'category_id' => $electronicsId
            ],
            [
                'name' => 'Leather Jacket',
                'description' => 'Premium leather jacket for men',
                'price' => 199.99,
                'stock' => 20,
                'category_id' => Category::where('name', 'Fashion')->first()->id
            ],
            [
                'name' => 'Football',
                'description' => 'Professional football',
                'price' => 29.99,
                'stock' => 80,
                'category_id' => $sportsId
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}