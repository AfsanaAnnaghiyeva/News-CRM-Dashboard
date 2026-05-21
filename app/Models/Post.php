<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;
use App\Models\Comment;

class Post extends Model
{
    use SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'image',
        'content',
        'view_count',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class,'post_id','id');
    }
}
