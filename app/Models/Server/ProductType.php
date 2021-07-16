<?php

namespace App\Models\Server;

use App\Models\Client\Transactions\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function warehouse()
    {
        return $this->hasMany(ProductType::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
