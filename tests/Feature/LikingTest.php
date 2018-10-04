<?php

namespace Tests\Feature;

use App\User;
use App\Thread;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikingTest extends TestCase
{
    use RefreshDatabase;

    public function testThreadCanBeLiked() {
        $this->actingAs(factory(User::class)->create());
        $thread = factory(Thread::class)->create();

        $thread->like();

        $this->assertCount(1, $thread->likes);
        $this->assertTrue($thread->likes->contains('id', auth()->id()));
    }

    public function testCommentCanBeLiked() {
        $this->actingAs(factory(User::class)->create());
        $comment = factory(Comment::class)->create();

        $comment->like();

        $this->assertCount(1, $comment->likes);
        $this->assertTrue($comment->likes->contains('id', auth()->id()));
    }
}
