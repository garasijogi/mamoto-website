<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaFAQController extends Controller
{
    public function index()
    {
        return view('admin.faq');
    }
}
