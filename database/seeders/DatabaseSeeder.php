<?php

namespace Database\Seeders;

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
