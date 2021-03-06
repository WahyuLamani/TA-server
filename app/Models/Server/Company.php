<?php

namespace App\Models\Server;

use App\Models\Client\Agent;
use App\Models\Client\Post;
use App\Models\Client\Transactions\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'slug',
        'company_address',
        'ceo_name',
        'company_email',
        'company_telp_num',
        'thumbnail',
        'location',
        'about',
    ];

    public function agent()
    {
        return $this->hasMany(Agent::class);
    }

    public function warehouse()
    {
        return $this->hasMany(Warehouse::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function product_type()
    {
        return $this->hasMany(ProductType::class);
    }

    public function post()
    {
        return $this->morphMany(Post::class, 'owner');
    }
}
