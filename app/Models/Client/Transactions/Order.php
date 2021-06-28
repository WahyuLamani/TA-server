<?php

namespace App\Models\Client\Transactions;

use App\Models\Client\Distributor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function distribution()
    {
        $this->hasOne(Distribution::class);
    }

    public function distributor()
    {
        $this->belongsTo(Distributor::class);
    }
}
