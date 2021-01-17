<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaAboutController extends Controller
{
    public function index()
    {
        return view('admin.about');
    }
}
