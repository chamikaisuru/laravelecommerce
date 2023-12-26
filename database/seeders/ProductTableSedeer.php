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

            // [
            //     'id' => 1,
            //     'category_id' => 8,
            //     'brand_id' => 0,
            //     'product_name' => 'Blue T-shirt',
            //     'product_code' => 'BT09',
            //     'product_color' => 'Dark Blue',
            //     'family_color' => 'Blue',
            //     'group_code' => 'TSHIRT0000',
            //     'product_price' => 1500,
            //     'product_discount' => '10',
            //     'discount_type' => 'product',
            //     'final_price' => 1350,
            //     'product_weight' => 500,
            //     'product_video' => '',
            //     'description' => 'Comfortable cotton t-shirt',
            //     'wash_care' => 'Machine washable',
            //     'keywords' => 'casual, cotton, t-shirt',
            //     'meta_title' => 'Red T-Shirt',
            //     'meta_description' => 'A comfortable red cotton t-shirt',
            //     'meta_keywords' => 'red, cotton, t-shirt',
            //     'is_featured' => 'yes',
            //     'status' => 1,

            // ],

            [
                'id' => 2,
                'category_id' => 8,
                'brand_id' => 0,
                'product_name' => 'Red T-shirt',
                'product_code' => 'RT09',
                'product_color' => 'Red',
                'family_color' => 'Red',
                'group_code' => 'TSHIRT0000',
                'product_price' => 1000,
                'product_discount' => '0',
                'discount_type' => 'product',
                'final_price' => 1000,
                'product_weight' => 500,
                'product_video' => '',
                'description' => 'Comfortable cotton t-shirt',
                'wash_care' => 'Machine washable',
                'keywords' => 'casual, cotton, t-shirt',
                'meta_title' => 'Red T-Shirt',
                'meta_description' => 'A comfortable red cotton t-shirt',
                'meta_keywords' => 'red, cotton, t-shirt',
                'is_featured' => 'no',
                'status' => 1,

            ],
        ];

        Product::insert($ProductRecords);
    }
}


