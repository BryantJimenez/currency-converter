<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['fixed_commission', 'percentage_commission', 'max_fixed_commission', 'iva'];
}
