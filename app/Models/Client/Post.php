<?php

namespace App\Models\Client;

use App\Models\Server\Company;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable = [
        'post',
        'pict'
    ];
    public function owner()
    {
        return $this->morphTo();
    }

    public function scopeByOwner($query, $owner)
    {
        return $query->where('owner_type', $owner);
    }

    public function scopeByCompanyId($query, $company_id)
    {
        return $query->whereHasMorph('owner', Agent::class, function (Builder $q) use ($company_id) {
            $q->where('company_id', $company_id);
        });
    }
}
