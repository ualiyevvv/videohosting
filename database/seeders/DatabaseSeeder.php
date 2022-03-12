<?php

namespace Database\Seeders;

use DB;
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
        // \App\Models\User::factory(10)->create();
        DB::table('strikes')->insert([
            'strike_name' => 'noneStrike'
        ]);
        DB::table('strikes')->insert([
            'strike_name' => 'violation'
        ]);
        DB::table('strikes')->insert([
            'strike_name' => 'shadowBan'
        ]);
        DB::table('strikes')->insert([
            'strike_name' => 'ban'
        ]);
        DB::table('categories')->insert([
            'cat_name' => 'new category'
        ]);
        DB::table('users')->insert([
            'nickname' => 'Admin',
            'email' => "admin@admin.ru",
            "password" => bcrypt("123"),
            'is_admin' => 1,
            "email_verified_at" => "2022-03-12 14:52:21"
        ]);
    }
}
