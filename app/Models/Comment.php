<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'post_id',
        'name',
        'content',
        'admin_reply'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
