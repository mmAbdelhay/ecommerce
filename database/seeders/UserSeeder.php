<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['name' => 'admin', 'email' => 'admin@admin.com', 'password' => '123456'])->assignRole(User::ADMIN);
        User::create(['name' => 'user', 'email' => 'user@user.com', 'password' => '123456'])->assignRole(User::USER);
    }
}
