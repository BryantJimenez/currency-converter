<?php

namespace App\Models\Currency;

use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    protected $fillable = ['conversion_rate', 'currency_id', 'currency_exchange_id'];
}
