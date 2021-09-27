<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => "1",
            'name' => "Super Admin",
            'email' => 'superadmin@gmail.com',
            'phone' => '+123456789',
            'password' => Hash::make('super@admin'),
        ]);
    }
}
