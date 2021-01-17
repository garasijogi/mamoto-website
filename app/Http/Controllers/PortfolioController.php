<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function wedding()
    {
        return view('portfolio', ['title' => 'Wedding']);
    }

    public function prewed()
    {
        return view('portfolio', ['title' => 'Pre Wedding']);
    }

    public function sp()
    {
        return view('portfolio', ['title' => 'Siraman/Pengajian']);
    }

    public function lamaran()
    {
        return view('portfolio', ['title' => 'Lamaran']);
    }
}
