<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_have_payment_method extends Model
{
    protected $fillable = [
        'user_id',
        'payment_method_id',
    ];
}
