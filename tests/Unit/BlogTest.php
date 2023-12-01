<?php

namespace Tests\Unit;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    public function test_get_blog_by_id()
    {
        $user = User::factory()->create();
        $blog = Blog::factory()->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/blog/' . $blog->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'user_id',
                    'title',
                    'content',
                    'created_at',
                    'user' => [
                        'id',
                        'name',
                        'email',
                        'avatar',
                        'phone',
                        'address',
                        'fullname',
                        'created_at',
                        'updated_at',
                        'role',
                    ],
                ],
            ])
            ->assertJson([
                'data' => [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    // Add other expected details
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        // Add other expected details
                    ],
                ],
            ]);
    }

    public function test_get_all_blogs()
    {
        $user = User::factory()->create();
        Blog::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/blog');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'user_id',
                        'title',
                        'content',
                        'created_at',
                        'user' => [
                            'id',
                            'name',
                            'email',
                            'avatar',
                            'phone',
                            'address',
                            'fullname',
                            'created_at',
                            'updated_at',
                            'role',
                        ],
                    ],
                ],
            ])
            ->assertJsonCount(3, 'data');
    }
}
