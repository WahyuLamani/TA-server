<?php

namespace App\Models\Client;

use App\Models\Distribution;
use App\Models\User;
use App\Models\Client\ProblemReporting;
use App\Models\Server\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'telp_num',
        'location',
        'thumbnail',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function distribution()
    {
        return $this->hasMany(Distribution::class);
    }

    public function container()
    {
        return $this->hasMany(Container::class);
    }

    // public function problemreporting()
    // {
    //     $this->hasMany(ProblemReporting::class);
    // }
}
