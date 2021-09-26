<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect('admin/pesanan');
        // return view('admin.dashboard');
    }
}