<?php

namespace Tests\Feature;

use App\Subreddit;
use App\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubredditThreadTest extends TestCase {
    use RefreshDatabase;

    public function testSubbredditCanHaveThread() {
        $subreddit = factory(Subreddit::class)->create();
        $thread = factory(Thread::class)->create(['subreddit_id' => $subreddit->id]);

        $this->assertCount(1, $subreddit->threads);
        $this->assertTrue($subreddit->threads->contains('id', $thread->id));
    }

    public function testSubbredditCanHaveMultipleThreads() {
        $subreddit = factory(Subreddit::class)->create();
        $thread = factory(Thread::class)->create(['subreddit_id' => $subreddit->id]);
        $thread2 = factory(Thread::class)->create(['subreddit_id' => $subreddit->id]);
        $thread3 = factory(Thread::class)->create(['subreddit_id' => $subreddit->id]);

        $this->assertCount(3, $subreddit->threads);
        $this->assertTrue($subreddit->threads->contains('id', $thread->id));
    }

    public function testThreadBelongsToSubreddit() {
        $subreddit = factory(Subreddit::class)->create();
        $thread = factory(Thread::class)->create(['subreddit_id' => $subreddit->id]);

        $this->assertEquals($thread->subreddit->id, $subreddit->id);
    }
}
