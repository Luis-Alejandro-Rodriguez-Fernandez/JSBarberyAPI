<?php

namespace Database\Seeders;

use App\Models\Roles\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserAdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => "Admin",
            'last_name' => "Barbery",
            'role_id' => Roles::getBossRole(),
            'email' => 'admin@barbery.com',
            'phone' => "",
            'password' => bcrypt('123456'),
            'birthday' => null,
        ]);
    }
}
