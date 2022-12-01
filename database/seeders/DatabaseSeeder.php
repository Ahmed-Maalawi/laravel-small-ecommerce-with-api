<?php

namespace Database\Seeders;

 use App\Models\Admin;
 use App\Models\category;
 use App\Models\User;
 use Database\Factories\categoryFactory;
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
        category::factory(5)->create();
//        User::factory(10)->create();

        // \App\Models\User::factory()->create([2
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
