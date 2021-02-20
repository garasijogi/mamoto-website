<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    public $incrementing = false;

    protected $fillable = ['id', 'name', 'post', 'link', 'photo'];
    protected $keyType = 'string';

}
