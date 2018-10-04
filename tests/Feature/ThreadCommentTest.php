<?php

namespace Tests\Feature;

use App\User;
use App\Thread;
use App\Comment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadCommentTest extends TestCase {
    use RefreshDatabase;

    public function testThreadHasComments() {
        $thread = factory(Thread::class)->create();
        $comment = factory(Comment::class)->create(['thread_id' => $thread->id]);
        $comment2 = factory(Comment::class)->create(['thread_id' => $thread->id]);
        $comment3 = factory(Comment::class)->create(['thread_id' => $thread->id]);

        $this->assertCount(3, $thread->comments);
        $this->assertTrue($thread->comments->contains('id', $comment->id));
    }

    public function testCommentBelongsToThread() {
        $thread = factory(Thread::class)->create();
        $comment = factory(Comment::class)->create(['thread_id' => $thread->id]);

        $this->assertEquals($comment->thread->id, $thread->id);
    }
}
