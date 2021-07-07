<?php

namespace App\Models\Client\Transactions;

use App\Models\Client\Agent;
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


    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
