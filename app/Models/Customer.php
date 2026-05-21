<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Sale;

class Customer extends Model
{
    use SoftDeletes;    

    protected $table = 'customers';

    protected $fillable = [
        'name',
        'logo',
        'link',
        'status'
    ];
     public function sales()
    {
        return $this->hasMany(Sale::class,'customer_id','id');
    }
}
