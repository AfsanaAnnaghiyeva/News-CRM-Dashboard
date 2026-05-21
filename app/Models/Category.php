<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Post;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'slug',
        'status',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class,'id','category_id');
    }
}
