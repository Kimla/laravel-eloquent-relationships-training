<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

    use Likable;

    public function thread() {
        return $this->belongsTo(Thread::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
