<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelolaFeedbackController extends Controller
{
    public function index()
    {
        return view('admin.feedback');
    }
}
