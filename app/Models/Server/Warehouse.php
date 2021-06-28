<?php

namespace App\Models\Server;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    public function company()
    {
        $this->belongsTo(Company::class);
    }
}
