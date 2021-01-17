<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaPesananController extends Controller
{
    public function index()
    {
        return view('admin.pesanan');
    }
}
