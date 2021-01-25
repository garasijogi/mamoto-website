<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = ['pfType_id', 'name', 'details', 'video', 'date', 'photo', 'slug'];
    protected $with = ['portfolio_type'];

    public function portfolio_type()
    {
        return $this->belongsTo(Portfolio_type::class, 'pfType_id');
    }

    public function getTakeImageAttribute($pfType, $photoName)
    {
        return "/storage/images/portfolio/{$pfType}/{$this->slug}/{$photoName}";
    }
}
