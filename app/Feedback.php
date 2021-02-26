<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
    'mempelai_pria', 'mempelai_wanita', 'kesan_pesan', 'kritik_saran'
    ];
}
