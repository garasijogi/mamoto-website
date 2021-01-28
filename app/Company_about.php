<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company_about extends Model
{
    protected $table = "company_about";
    protected $primaryKey = "id";
    protected $keyType = "boolean";
}
