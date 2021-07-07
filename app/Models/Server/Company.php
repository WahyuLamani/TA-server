<?php

namespace App\Models\Server;

use App\Models\Client\Agent;
use App\Models\Client\Transactions\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
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
        $this->hasMany(Warehouse::class);
    }

    public function order()
    {
        $this->hasMany(Order::class);
    }

    public function product_type()
    {
        $this->hasMany(ProductType::class);
    }

    public function post()
    {
        return $this->morphMany(Post::class, 'owner');
    }
}
