<?php

namespace App\Models;

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
}
