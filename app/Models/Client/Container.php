<?php

namespace App\Models\Client;

use App\Models\Client\Transactions\Distribution;
use App\Models\Server\Warehouse;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    use HasFactory;

    protected $table = 'container';

    protected $fillable = [
        'warehouse_id',
        'amount',
        'count_down_amount'
    ];



    public function distribution()
    {
        return $this->hasMany(Distribution::class);
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
