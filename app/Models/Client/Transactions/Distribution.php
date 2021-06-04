<?php

namespace App\Models\Client\Transactions;

use App\Models\Client\Agent;
use App\Models\Client\Distributor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'distributor_id',
        'dis_item',
        'info'
    ];


    public function agent()
    {
        $this->belongsTo(Agent::class);
    }

    public function distributor()
    {
        $this->belongsTo(Distributor::class);
    }
}
