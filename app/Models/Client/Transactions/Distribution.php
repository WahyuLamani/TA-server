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
        'amount',
        'info',
        'added_at'
    ];



    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function container()
    {
        return $this->belongsTo(Container::class);
    }

    public function scopeByCompany($query, $company_id)
    {
        return $query->whereHas('container', function (Builder $q) use ($company_id) {
            $q->whereHas('agent', function (Builder $q) use ($company_id) {
                $q->where('company_id', $company_id);
            });
        });
    }
    public function scopeByAgent($query, $agent_id)
    {
        return $query->whereHas('container', function (Builder $q) use ($agent_id) {
            $q->where('agent_id', $agent_id);
        });
    }
    public function scopeByDistributor($query, $distributor_id)
    {
        return $query->whereHas('order', function (Builder $q) use ($distributor_id) {
            $q->where('distributor_id', $distributor_id);
        });
    }

    public function scopeByProductType($query, $product_type_id)
    {
        return $query->whereHas('order', function (Builder $q) use ($product_type_id) {
            $q->where('product_type_id', $product_type_id);
        });
    }
}
