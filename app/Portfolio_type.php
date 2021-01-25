<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio_type extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'pfType_id');
    }
}
