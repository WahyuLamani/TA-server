<?php

namespace App\Models\Client\Transactions;

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
        $this->belongsTo(Agent::class);
    }

    public function order()
    {
        $this->belongsTo(Order::class);
    }
}
