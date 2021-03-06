<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name' => 'Masker',
            'product_price' => 5000,
            'category_id' => 1,
        ]);
        DB::table('products')->insert([
            'product_name' => 'Face Shield',
            'product_price' => 8000,
            'category_id' => 1,
        ]);
    }
}
