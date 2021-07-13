<?php

namespace App\Models\Client;

use App\Models\Client\Transactions\Order;
use App\Models\User;
use App\Models\Server\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
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

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function post()
    {
        return $this->morphMany(Post::class, 'owner');
    }

    public function scopeByContainerOnTruck($query)
    {
        return $query->whereHas('container', function ($q) {
            $q->where('on_truck', 1);
        });
    }
}
