<?php

namespace App\Http\Controllers;

use App\Portfolio_type;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function wedding(Portfolio_type $portfolio_types)
    {
        $portfolios = $portfolio_types->find('W')->portfolios()->limit(10)->latest()->paginate(10);
        return view('portfolio', [
            'title' => 'Wedding',
            'portfolios' => $portfolios
        ]);
    }

    public function prewed(Portfolio_type $portfolio_types)
    {
        $portfolios = $portfolio_types->find('preW')->portfolios()->limit(10)->latest()->paginate(10);
        return view('portfolio', [
            'title' => 'Pre Wedding',
            'portfolios' => $portfolios
        ]);
    }

    public function sp(Portfolio_type $portfolio_types)
    {
        $portfolios = $portfolio_types->find('S')->portfolios()->limit(10)->latest()->paginate(10);
        return view('portfolio', [
            'title' => 'Siraman/Pengajian',
            'portfolios' => $portfolios
        ]);
    }

    public function lamaran(Portfolio_type $portfolio_types)
    {
        $portfolios = $portfolio_types->find('L')->portfolios()->limit(10)->latest()->paginate(10);
        return view('portfolio', [
            'title' => 'Lamaran',
            'portfolios' => $portfolios
        ]);
    }
}
