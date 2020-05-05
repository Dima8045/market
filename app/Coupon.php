<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    const COUPON_TYPE = ['percent', 'fixed'];

    protected $guarded = [];
}
