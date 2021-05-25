<?php

namespace App\Models\Client\Transactions;

use App\Models\Client\Agent;
use App\Models\Client\Distributor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    public function agent()
    {
        $this->belongsTo(Agent::class);
    }

    public function distributor()
    {
        $this->belongsTo(Distributor::class);
    }
}
