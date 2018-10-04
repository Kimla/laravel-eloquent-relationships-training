<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model {

    use Likable;

    public function subreddit() {
        return $this->belongsTo(Subreddit::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
