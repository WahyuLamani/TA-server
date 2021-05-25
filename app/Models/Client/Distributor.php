<?php

namespace App\Models\Client;

use App\Models\Distribution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    public function distribution()
    {
        $this->hasMany(Distribution::class);
    }
}
