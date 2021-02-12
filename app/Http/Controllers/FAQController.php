<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {   
        $faq = Faq::get();
        return view('faq', compact('faq'));
    }
}
