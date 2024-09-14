<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminConfigSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('admin_config')->insert([
            'phone' => null,
            'email' => null,
            'first_journal' => null,
            'second_journal' => null,
            'disabled_days' => null,
            'instagram' => null,
            'tiktok' => null,
        ]);
    }
}
