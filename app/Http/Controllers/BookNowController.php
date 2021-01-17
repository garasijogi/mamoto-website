<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookNowController extends Controller
{
    public function index()
    {
        return view('booknow');
    }
}
