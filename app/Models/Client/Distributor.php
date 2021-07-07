<?php

namespace App\Models\Client;

use App\Models\Client\Transactions\Order;
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

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function post()
    {
        return $this->morphMany(Post::class, 'owner');
    }
}
