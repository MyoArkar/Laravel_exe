<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'id' => 1,
                'name' => 'product1',
                'description' => 'description1',
                'price' => 10
            ],
            [
                'id' => 2,
                'name' => 'product2',
                'description' => 'description2',
                'price' => 20
            ],
            [
                'id' => 3,
                'name' => 'product3',
                'description' => 'description3',
                'price' => 30
            ],
            [
                'id' => 4,
                'name' => 'product4',
                'description' => 'description4',
                'price' => 40
            ],
            [
                'id' => 5,
                'name' => 'product5',
                'description' => 'description5',
                'price' => 50
            ],
            [
                'id' => 6,
                'name' => 'product6',
                'description' => 'description6',
                'price' => 60
            ],
        ];
        foreach($products as $product)
        {
            Product::create($product);
        }
    }
}
