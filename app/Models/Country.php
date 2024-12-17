<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public function throughData()
    {
        return $this->hasManyThrough(Post::class, User::class);
//        return $this->hasOneThrough(User::class, Post::class);
    }

    public function manyUser()
    {
        return $this->hasManyThrough(Post::class, User::class);
    }
}
