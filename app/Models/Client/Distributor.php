<?php

namespace App\Models\Client;

use App\Models\Distribution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'telp_num',
        'location',
        'thumbnail',
    ];

    public function distribution()
    {
        $this->hasMany(Distribution::class);
    }
}
