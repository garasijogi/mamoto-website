<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
