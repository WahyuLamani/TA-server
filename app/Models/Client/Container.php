<?php

namespace App\Models\Client;

use App\Models\Server\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $table = 'container';


    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }
}
