<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books_package extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
}
