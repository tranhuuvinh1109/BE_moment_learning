<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Tran Huu Vinh',
            'email' => 'vinh@gmail.com',
            'password' => bcrypt('adminadmin'),
            'role' => 0
        ]);
    }
}
