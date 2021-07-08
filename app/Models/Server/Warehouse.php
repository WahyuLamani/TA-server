<?php

namespace App\Models\Server;

use App\Models\Client\Container;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'warehouse';

    protected $fillable = [
        'product_type_id',
        'amount',
        'count_down_amount'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function container()
    {
        return $this->hasMany(Container::class);
    }
}
