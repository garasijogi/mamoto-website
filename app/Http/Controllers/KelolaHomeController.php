<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaHomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }
}
