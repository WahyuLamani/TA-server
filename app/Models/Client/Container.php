<?php

namespace App\Models\Client;

use App\Models\Client\Transactions\{Distribution, order};
use App\Models\Server\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $table = 'container';

    protected $fillable = [
        'warehouse_id',
        'amount',
        'count_down_amount',
        'order_id',
    ];



    public function distribution()
    {
        return $this->hasMany(Distribution::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
