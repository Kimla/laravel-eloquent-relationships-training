<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\Subreddit;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubredditSubscribeTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanSubscribe() {
        $user = factory(User::class)->create();
        $subreddit = factory(Subreddit::class)->create();

        $subreddit->subscribe($user);

        $this->assertCount(1, $subreddit->users);
        $this->assertTrue($subreddit->users->contains('id', $user->id));
    }

    public function testUserCanUnsubscribe() {
        $user = factory(User::class)->create();
        $subreddit = factory(Subreddit::class)->create();

        $subreddit->subscribe($user);
        $subreddit->unsubscribe($user);

        $this->assertCount(0, $subreddit->users);
    }

    public function testUserCanSubscribeToMultiple() {
        $user = factory(User::class)->create();
        $subreddit = factory(Subreddit::class)->create();
        $subreddit2 = factory(Subreddit::class)->create();
        $subreddit3 = factory(Subreddit::class)->create();

        $subreddit->subscribe($user);
        $subreddit2->subscribe($user);
        $subreddit3->subscribe($user);

        $this->assertCount(3, $user->subreddits);
    }

    public function testUserCantSubscribeToSameTwice() {
        $this->expectException('Illuminate\Database\QueryException');

        $user = factory(User::class)->create();
        $subreddit = factory(Subreddit::class)->create();

        $subreddit->subscribe($user);
        $subreddit->subscribe($user);
        
        $this->assertCount(1, $user->subreddits);
    }

    public function testMultipleUsersCanSubscribeToSameSubReddit() {
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $subreddit = factory(Subreddit::class)->create();

        $subreddit->subscribe($user);
        $subreddit->subscribe($user2);

        $this->assertCount(2, $subreddit->users);
    }
}
