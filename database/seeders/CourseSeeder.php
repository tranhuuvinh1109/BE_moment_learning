<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name'=>'HTML/CSS',
            'teacher' => 1,
            'category' => 1,
            'price'=>500,
            'description' => 'HTML/CSS this is description',
            'image' => 'https://firebasestorage.googleapis.com/v0/b/moment-learning.appspot.com/o/images%2Fcourse%2Fcourse1679305513895?alt=media&token=5b95c572-26f0-40bf-a323-8045c307fa64',
            'total_star' => 4,
        ];
        DB::table('course')->insert($data);
    }
}
