<?php

namespace Tests\Feature;

use App\Comment;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentOwnerTest extends TestCase {
    use RefreshDatabase;

    public function testCommentHasOwner() {
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create(['user_id' => $user->id]);

        $this->assertEquals($comment->user->id, $user->id);
    }

    public function testUserHasComments() {
        $user = factory(User::class)->create();
        $comment = factory(Comment::class)->create(['user_id' => $user->id]);
        $comment2 = factory(Comment::class)->create(['user_id' => $user->id]);
        $comment3 = factory(Comment::class)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->comments);
        $this->assertTrue($user->comments->contains('id', $comment->id));
    }
}
