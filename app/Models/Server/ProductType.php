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
        return $this->hasMany(Warehouse::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function scopeByValueOnWarehouse($query)
    {
        return $query->whereHas('warehouse', function ($q) {
            $q->where('count_down_amount', '>', 0);
        });
    }
}
