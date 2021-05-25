<?php

namespace App\Models\Client;

use App\Models\Distribution;
use App\Models\User;
use App\Models\Client\ProblemReporting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'email', 'telp_num', 'password'];

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
}