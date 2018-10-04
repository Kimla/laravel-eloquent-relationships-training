<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subreddit extends Model {
    public function subscribe($user) {
        $this->users()->attach($user);
    }

    public function unsubscribe($user) {
        $this->users()->detach($user);
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }

    public function threads() {
        return $this->hasMany(Thread::class);
    }
}
