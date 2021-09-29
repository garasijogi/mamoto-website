<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book_status;

class Book extends Model
{
    protected $fillable = [
        'name', 'phone', 'email', 'events', 'booking_date', 'location', 'note', 'status'
    ];
}
