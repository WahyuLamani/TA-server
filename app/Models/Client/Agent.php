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
        'thumnail',
    ];

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function distribution()
    {
        $this->hasMany(Distribution::class);
    }

    public function problemreporting()
    {
        $this->hasMany(ProblemReporting::class);
    }

    public function company()
    {
        $this->hasMany(Company::class);
    }
}
