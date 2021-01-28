<?php

namespace App\Http\Controllers;

use App\Company_about;
use Illuminate\Http\Request;

class KelolaAboutController extends Controller
{
    public function index()
    {
        return Company_about::where('id', 0)->get();

        return view('admin.about');
    }
}
