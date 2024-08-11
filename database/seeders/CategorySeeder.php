<?php

namespace Database\Seeders;

use Brick\Math\BigInteger;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'title' => 'Electronics',
                'parent_id' => null,
            ],
            [
                'title' => 'Laptops',
                'parent_id' => 1,
            ],
            [
                'title' => 'Mobile Phones',
                'parent_id' => 1,
            ],
            [
                'title' => 'Furniture',
                'parent_id' => null,
            ],
            [
                'title' => 'Chairs',
                'parent_id' => 4,
            ],
            [
                'title' => 'Tables',
                'parent_id' => 4,
            ],
        ]);
    }
}
