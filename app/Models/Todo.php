<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Todo extends Model
{
    use SoftDeletes;

    protected $table = 'todos';

    protected $fillable = [
        'user_id',
        'title',
        'is_completed'
    ];

   public function user()
   {
    return $this->belongsTo(User::class,'user_id','id');
   }
}
