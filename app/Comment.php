<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	protected $fillable = [
       'post_id', 'email', 'blog','full_name','comment','reply_id','created_by'
    ];
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
