<?php

namespace App\Models\Client;

use App\Models\Client\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemReporting extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'post',
        'pict'
    ];
    public function agent()
    {
        $this->belongsTo(Agent::class);
    }
}
