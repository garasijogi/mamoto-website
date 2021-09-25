<?php

namespace App\Http\Controllers;

use App\Company_jumbotron;
use App\Displayed_feedback;
use App\Displayed_portfolio;
use App\DisplayedPromo;
use App\Promo;
use App\Contact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $promo = DisplayedPromo::all();
        $jumbotrons = Company_jumbotron::get();
        $displayed_portfolios = Displayed_portfolio::with('portfolio')->get();
        $displayed_feedbacks = Displayed_feedback::with('feedback')->whereNotNull('feedback_id')->get();
        $whatsapp = Contact::where('name', 'whatsapp')->first();
        return view('home', compact('jumbotrons', 'displayed_portfolios', 'displayed_feedbacks', 'promo', 'whatsapp'));
    }
}
