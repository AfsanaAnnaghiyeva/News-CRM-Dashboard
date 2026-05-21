<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sale;

class Service extends Model
{
    use SoftDeletes;
    
    protected $table = 'services';

    protected $fillable = [
        'title',
        'description',
        'price',
        'status'
    ];
      public function sales()
    {
        return $this->hasMany(Sale::class,'service_id','id');
    }
}
