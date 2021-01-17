<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaPromoController extends Controller
{
    public function index()
    {
        return view('admin.promo');
    }
}
