<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;

class PostModelTest extends TestCase
{

    public function test_post_has_title_and_content(): void
    {
        $post = new \App\Models\Post();
        $post->title = 'Test Title';
        $post->content = 'Test Content';

        $this->assertEquals('Test Title', $post->title);
        $this->assertEquals('Test Content', $post->content);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
    }

}
