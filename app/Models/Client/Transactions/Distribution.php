<?php

namespace App\Models\Client\Transactions;

use App\Models\Client\Container;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'order_id',
        'dis_item',
        'info'
    ];



    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function scopeByContainer($query)
    {
        return $query->whereHas('container');
    }

    public function scopeByAgent($query, $agent)
    {
        return $query->whereHas('container', function (Builder $q) use ($agent) {
            $q->whereHas('agent', function (Builder $q) use ($agent) {
                $q->where('company_id', $agent);
            });
        });
    }
}
