<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Displayed_feedback extends Model
{
    protected $guarded = [];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
