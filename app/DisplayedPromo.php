<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DisplayedPromo extends Model
{
    protected $fillable = ['promo_id'];
    public $timestamps = false;

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }
}
