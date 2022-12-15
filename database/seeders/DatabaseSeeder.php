<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\category;
use App\Models\product;
use App\Models\product_item;
use App\Models\User;
use App\Models\variation_option;
use App\Models\variation;
use Database\Factories\categoryFactory;
use Database\Factories\productItemFactory;
use App\Models\address;
use App\Models\user_address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Admin::factory(1)->create();
        User::factory(10)->create();

       $categories = category::factory(3)->create()->each(function ($category) {
           variation::factory(rand(1,3))->create([
               'category_id' => $category->id
           ])->each(function ($variation) {
               variation_option::factory(3)->create([
                   'variation_id' => $variation->id
               ]);
           });

           $products = product::factory(5)->create([
               'category_id' => $category->id,
           ])->each(function ($product) {
               product_item::factory(2)->create([
                   'product_id' => $product->id,
               ]);
           });
       });








//======================================================
//        category::factory()->create([
//            'category_name' => 'ملابس',
//            'parent_category_id' => null,
//        ]);
//
//        category::factory()->create([
//            'category_name' => 'رجالي',
//            'parent_category_id' => 1,
//        ]);
//
//        category::factory()->create([
//            'category_name' => 'شورتات',
//            'parent_category_id' => 2,
//        ]);
//
//
//        variation::factory()->create([
//            'name' => 'اللون',
//            'category_id' => 3,
//        ]);
//
//        variation::factory()->create([
//            'name' => 'المقاس',
//            'category_id' => 3,
//        ]);



        //         address::factory(20)->create();
        //         $addresses = address::all();


        // \App\Models\User::factory()->create([2
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


    }
}
