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
=======
 use App\Models\address;
 use App\Models\Admin;
 use App\Models\User;
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
//        category::factory(5)->create();

        category::factory()->create([
           'category_name' => 'ملابس',
            'parent_category_id' => null,
        ]);

        category::factory()->create([
            'category_name' => 'رجالي',
            'parent_category_id' => 1,
        ]);

        category::factory()->create([
            'category_name' => 'شورتات',
            'parent_category_id' => 2,
        ]);


        variation::factory()->create([
            'name' => 'اللون',
            'category_id' => 3,
        ]);

        variation::factory()->create([
            'name' => 'المقاس',
            'category_id' => 3,
        ]);

//        variation_option::factory()->create([
//            'value' => 'احمر',
//            'variation_id' => 1,
//        ]);
//
//        variation_option::factory()->create([
//            'value' => 'اسود',
//            'variation_id' => 1,
//        ]);
//
//        variation_option::factory()->create([
//            'value' => 'ابيض',
//            'variation_id' => 1,
//        ]);
//
//        variation_option::factory()->create([
//            'value' => 'S',
//            'variation_id' => 2,
//        ]);
//
//        variation_option::factory()->create([
//            'value' => 'M',
//            'variation_id' => 2,
//        ]);
//
//        variation_option::factory()->create([
//            'value' => 'L',
//            'variation_id' => 2,
//        ]);
//
//        variation_option::factory()->create([
//            'value' => 'XL',
//            'variation_id' => 2,
//        ]);
//
//        variation_option::factory()->create([
//            'value' => 'XXL',
//            'variation_id' => 2,
//        ]);
//        ----------------------------------------------------------

//        product::factory()->create([
//            'category_id' => 3,
//            'name' => 'شورت كوتونيل',
//            'description' =>'شوت كوتونيل قطن من اجود الانواع',
//            'product_image' => 'public/uploads/products/02227d8f-7903-4957-9ae7-0ffb8a3737a3.avif',
//        ]);
//
//        product_item::factory()->create([
//            'product_id' => 1,
//            'sku' => 's5df5b2xv54',
//            'qty_in_stock' => 10,
//            'product_image' => 'public/uploads/products/02227d8f-7903-4957-9ae7-0ffb8a3737a3.avif',
//            'price' => 250,
//        ]);



//        product_item::factory()->create([
//            'product_id' => 1,
//            'sku' => 's5df5b2xv53',
//            'qty_in_stock' => 5,
//            'product_image' => 'public/uploads/products/02227d8f-7903-4957-9ae7-0ffb8a3737a3.avif',
//            'price' => 260,
//        ]);




//        User::factory(10)->create();
=======
         User::factory(10)->create();
         Admin::factory(1)->create();
//         address::factory(20)->create();
//         $addresses = address::all();


        // \App\Models\User::factory()->create([2
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


    }
}
