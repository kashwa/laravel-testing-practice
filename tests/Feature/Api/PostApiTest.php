<?php

namespace Tests\Feature\Api;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_all_posts()
    {
        // Create some posts
        Post::create(['title' => 'Post 1', 'content' => 'Content 1']);
        Post::create(['title' => 'Post 2', 'content' => 'Content 2']);

        // Test the API endpoint
        $response = $this->getJson('/api/posts');

        // Assert the response
        $response->assertStatus(200)
            ->assertJsonCount(2)
            ->assertJsonStructure([
                '*' => ['id', 'title', 'content', 'created_at', 'updated_at'],
            ]);
    }

    public function test_can_create_post()
    {
        $postData = [
            'title' => 'New Post',
            'content' => 'New Content',
        ];

        $response = $this->postJson('/api/posts', $postData);

        $response->assertStatus(201)
        ->assertJson([
            'title' => 'New Post',
            'content' => 'New Content',
        ]);
    }

    public function test_can_get_single_post()
    {
        $post = Post::create([
            'title' => 'Single Post',
            'content' => 'Single Content'
        ]);

        $response = $this->getJson("/api/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJson( [
                'id' => $post->id,
                'title' => 'Single Post',
                'content' => 'Single Content',
        ]);
    }

    public function test_can_update_post()
    {
        $post = Post::create([
            'title' => 'Old Title',
            'content' => 'Old Content'
        ]);

        $updateData = [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ];

        $response = $this->putJson("/api/posts/{$post->id}", $updateData);

        $response->assertStatus(200)
            ->assertJson($updateData);

        $this->assertDatabaseHas('posts', $updateData);
    }

    public function test_can_delete_post()
    {
        $post = Post::create([
            'title' => 'Post to Delete',
            'content' => 'Content to Delete'
        ]);


        $response = $this->deleteJson("/api/posts/{$post->id}");
        $response->assertStatus(204);
        $this->assertDatabaseMissing('posts',['id' => $post->id]);
    }
}
