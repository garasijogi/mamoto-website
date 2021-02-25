<?php

namespace App\Http\Controllers;

use App\Company_jumbotron;
use App\Displayed_portfolio;
use Illuminate\Http\Request;

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
        $jumbotrons = Company_jumbotron::get();
        $displayed_portfolios = Displayed_portfolio::with('portfolio')->get();
        return view('home', compact('jumbotrons', 'displayed_portfolios'));
    }
}
