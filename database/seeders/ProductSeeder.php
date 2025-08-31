<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

/**
 * ProductSeeder seeds the database with example categories and products.
 *
 * This seeder provides a handful of sample categories and products with
 * various prices, stock levels, and gender targeting to showcase the
 * features of the e‑commerce application. You can run this seeder
 * using php artisan db:seed --class=ProductSeeder.
 */
class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Create categories. We only use men and women categories for clothing.
        $categories = [
            'Men' => 'Men clothing',
            'Women' => 'Women clothing',
        ];

        $categoryIds = [];
        foreach ($categories as $name => $description) {
            $category = Category::create([
                'name' => $name,
                'description' => $description,
            ]);
            $categoryIds[$name] = $category->id;
        }

        // Sample products for men and women clothing
        $products = [
            [
                'name' => "Classic Men's T-Shirt",
                'category' => 'Men',
                'description' => 'Comfortable cotton T-shirt for men.',
                'price' => 19.99,
                'stock' => 100,
                'image_url' => 'https://via.placeholder.com/200x200?text=Mens+T-Shirt',
                'target_gender' => 'male',
            ],
            [
                'name' => "Casual Men's Jeans",
                'category' => 'Men',
                'description' => 'Stylish blue jeans for men.',
                'price' => 49.99,
                'stock' => 80,
                'image_url' => 'https://via.placeholder.com/200x200?text=Mens+Jeans',
                'target_gender' => 'male',
            ],
            [
                'name' => "Elegant Women's Dress",
                'category' => 'Women',
                'description' => 'Elegant evening dress for women.',
                'price' => 79.99,
                'stock' => 60,
                'image_url' => 'https://via.placeholder.com/200x200?text=Womens+Dress',
                'target_gender' => 'female',
            ],
            [
                'name' => "Women's Summer Top",
                'category' => 'Women',
                'description' => 'Lightweight summer top for women.',
                'price' => 29.99,
                'stock' => 90,
                'image_url' => 'https://via.placeholder.com/200x200?text=Womens+Top',
                'target_gender' => 'female',
            ],
        ];

        foreach ($products as $data) {
            Product::create([
                'category_id' => $categoryIds[$data['category']],
                'name' => $data['name'],
                'description' => $data['description'],
                'price' => $data['price'],
                'stock' => $data['stock'],
                'image_url' => $data['image_url'],
                'target_gender' => $data['target_gender'],
            ]);
        }
    }
}