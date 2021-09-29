<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'period_start', 'period_end', 'post', 'link', 'photo'];
    protected $keyType = 'string';

}
