<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'title' => 'MacBook Pro',
                'description' => 'Apple MacBook Pro 14-inch with M1 chip',
                'price' => 1999,
                'category_id' => 1, // Assuming Electronics
                'subcategory_id' => 2, // Assuming Laptops
            ],
            [
                'title' => 'iPhone 13',
                'description' => 'Apple iPhone 13 with 128GB storage',
                'price' => 999,
                'category_id' => 1, // Assuming Electronics
                'subcategory_id' => 3, // Assuming Mobile Phones
            ],
            [
                'title' => 'Ergonomic Office Chair',
                'description' => 'Comfortable office chair with adjustable height',
                'price' => 149,
                'category_id' => 4, // Assuming Furniture
                'subcategory_id' => 5, // Assuming Chairs
            ],
            [
                'title' => 'Dining Table',
                'description' => 'Wooden dining table for 6 people',
                'price' => 299,
                'category_id' => 4, // Assuming Furniture
                'subcategory_id' => 6, // Assuming Tables
            ],
        ]);
    }
}
