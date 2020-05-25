<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_method extends Model
{
    protected $fillable = [
        'name',
        'back_rate',
    ];
}
