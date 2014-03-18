<?php
class ProductSeeder extends \Illuminate\Database\Seeder {

    public function run()
    {
        DB::table('products')->delete();

        Product::create(array(
            'title' => 'product 1',
            'price' => 200
        ));

        Product::create(array(
            'title' => 'product 2',
            'price' => 500
        ));

        Product::create(array(
            'title' => 'product 3',
            'price' => 700
        ));
    }

} 