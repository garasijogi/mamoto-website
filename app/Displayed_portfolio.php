<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Displayed_portfolio extends Model
{
    protected $guarded = [];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}
