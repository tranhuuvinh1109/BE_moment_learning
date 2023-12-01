<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\User;
use App\Models\Course;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CourseTest  extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_courses()
    {
        Course::factory()->count(3)->create();

        $response = $this->getJson('/api/course');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'teacher',
                        'category',
                        'price',
                        'description',
                        'image',
                        'total_star',
                        'created_at',
                        'lessons', // Adjust with the actual structure
                        'plans',   // Adjust with the actual structure
                    ],
                ],
            ]);

        $this->assertCount(3, $response->json('data'));
    }

    public function test_get_course_detail()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/api/course/{$course->id}&user_id=1");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'teacher',
                    'category',
                    'price',
                    'description',
                    'image',
                    'total_star',
                    'created_at',
                    'lessons', // Adjust with the actual structure
                    'plans',   // Adjust with the actual structure
                    'check_purchased_course',
                ],
            ]);

        $this->assertEquals(1, $response->json('data.check_purchased_course'));
    }
}
