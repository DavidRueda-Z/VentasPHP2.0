<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'shift_id',
        'name',
        'status',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function sales()
    {
        return $this->hasMany(AccountSale::class);
    }
}

