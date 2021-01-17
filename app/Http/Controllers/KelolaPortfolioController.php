<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaPortfolioController extends Controller
{
    public function index()
    {
        return view('admin.portfolio');
    }
}
