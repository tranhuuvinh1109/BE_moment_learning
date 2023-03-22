<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'user_id'=>3,
            'degree' => 'lecturers',
            'workplace' => 'DN'
        ];
        DB::table('teacher')->insert($data);
    }
}
