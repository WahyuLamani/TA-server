<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Client\Agent;

class CompanyAgents extends Model
{
    use HasFactory;

    public function agents()
    {
        $this->belongsTo(Agent::class);
    }
}
