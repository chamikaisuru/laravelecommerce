<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ProductRecords = [

            [
                'id' => 1,
                'category_id' => 8,
                'brand_id' => 0,
                'product_name' => 'Blue T-shirt',
                'product_code' => 'BT09',
                'product_color' => 'Dark Blue',
                'family_color' => 'Blue',
                'group_code' => 'TSHIRT0000',
                'product_price' => 1500,
                'product_discount' => '10',
                'discount_type' => 'product',
                'final_price' => 1350,
                'product_weight' => 500,
                'product_video' => '',
                'description' => 'Test Product',
                'wash_care' => '',
                'keywords' => '',
                'filters' => 'fabric ',
                'meta_title' => ,
                'meta_description' => ,
                'meta_keywords' => ,
                'is_featured' => ,
                'status' => ,

            ],

        ];

        Product::insert($ProductRecords);
    }
}


