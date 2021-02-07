<?php

namespace App\Http\Controllers;

use App\Company_about;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = Company_about::find(0)->first();

        return view('about', compact('about'));
    }
}
