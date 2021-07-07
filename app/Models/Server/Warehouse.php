<?php

namespace App\Models\Server;

use App\Models\Client\Container;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouse';

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function product_type()
    {
        return $this->hasMany(ProductType::class);
    }

    public function container()
    {
        return $this->hasMany(Container::class);
    }
}
