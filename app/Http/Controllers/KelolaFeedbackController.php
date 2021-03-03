<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class KelolaFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks =  Feedback::get();
        return view('admin.feedback', compact('feedbacks'));
    }
}
