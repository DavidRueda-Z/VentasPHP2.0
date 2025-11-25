<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'initial_amount',
        'final_amount',
        'total_sales',
        'status',
        'opened_at',
        'closed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sales()
{
    return $this->hasMany(Sale::class);
}

public function accounts()
{
    return $this->hasMany(Account::class);
}


}

