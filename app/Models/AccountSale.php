<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountSale extends Model
{
    protected $fillable = [
        'account_id',
        'product_id',
        'quantity',
        'amount',
        'total_amount',
        'sold_at',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

