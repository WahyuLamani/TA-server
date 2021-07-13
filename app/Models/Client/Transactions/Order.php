<?php

namespace App\Models\Client\Transactions;

use App\Models\Client\Agent;
use App\Models\Client\Distributor;
use App\Models\Server\Company;
use App\Models\Server\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function distribution()
    {
        return $this->hasOne(Distribution::class);
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function product_type()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
