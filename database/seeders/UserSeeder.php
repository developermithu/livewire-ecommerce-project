<?php

namespace Database\Seeders;

use App\Models\Sale;
use App\Models\User;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
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

        User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => Date::now(),
            'password' => bcrypt('admin'),
            'utype' => 'ADMIN',
        ]);

        User::updateOrCreate([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'email_verified_at' => Date::now(),
            'password' => Hash::make('user'),
            'utype' => 'USER',
        ]);

        // Sale Time Seeder
        Sale::updateOrCreate([
            'sale_time' => Date::now(),
            'status' => false,
        ]);
    }
}
