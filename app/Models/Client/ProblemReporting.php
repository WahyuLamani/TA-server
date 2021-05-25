<?php

namespace App\Models\Client;

use App\Models\Client\Agent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemReporting extends Model
{
    use HasFactory;

    public function agent()
    {
        $this->belongsTo(Agent::class);
    }
}
