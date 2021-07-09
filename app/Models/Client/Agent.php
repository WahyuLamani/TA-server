<?php

namespace App\Models\Client;

use App\Models\User;
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

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function container()
    {
        return $this->hasMany(Container::class);
    }

    public function post()
    {
        return $this->morphMany(Post::class, 'owner');
    }
}
