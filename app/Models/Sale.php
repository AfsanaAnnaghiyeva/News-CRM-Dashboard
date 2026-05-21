<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $table = 'sales';

    protected $fillable = [
        'customer_id',
        'service_id',
        'price',
        'sale_date',
        'note'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
     public function service()
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }
}
