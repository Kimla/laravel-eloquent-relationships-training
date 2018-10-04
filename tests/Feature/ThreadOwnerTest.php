<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadOwnerTest extends TestCase {
    use RefreshDatabase;

    public function testThreadHasOwner() {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create(['user_id' => $user->id]);

        $this->assertEquals($thread->user->id, $user->id);
    }

    public function testUserHasThreads() {
        $user = factory(User::class)->create();
        $thread = factory(Thread::class)->create(['user_id' => $user->id]);
        $thread2 = factory(Thread::class)->create(['user_id' => $user->id]);
        $thread3 = factory(Thread::class)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->threads);
        $this->assertTrue($user->threads->contains('id', $thread->id));
    }
}
