<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    protected $fillable = [
      'post_id',
      'guest_name',
      'guest_email',
      'comment_text',
      'status'
    ];
    
    public function post()
    {
      return $this->belongsTo(Post::class,'post_id','id');
    }
}
