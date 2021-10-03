<?php

namespace App\Http\Controllers;

use App\Portfolio;
use App\Portfolio_type;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function wedding(Portfolio_type $portfolio_types)
    {
        $portfolios = $this->get_portfolios($portfolio_types, 'W');
        
        return view('portfolio', [
            'title' => 'Wedding',
            'portfolios' => $portfolios
        ]);
    }

    public function prewed(Portfolio_type $portfolio_types)
    {
        $portfolios = $this->get_portfolios($portfolio_types, 'preW');

        return view('portfolio', [
            'title' => 'Pre Wedding',
            'portfolios' => $portfolios
        ]);
    }

    public function sp(Portfolio_type $portfolio_types)
    {
        $portfolios = $this->get_portfolios($portfolio_types, 'S');

        return view('portfolio', [
            'title' => 'Siraman/Pengajian',
            'portfolios' => $portfolios
        ]);
    }

    public function lamaran(Portfolio_type $portfolio_types)
    {
        $portfolios = $this->get_portfolios($portfolio_types, 'L');

        return view('portfolio', [
            'title' => 'Lamaran',
            'portfolios' => $portfolios
        ]);
    }

    public function show(Portfolio_type $pfType_id, Portfolio $portfolios){
        return view('showportfolio', [
            'title' => $portfolios->name,
            'portfolio' => $portfolios
        ]);
    }

    public function get_portfolios($model, $type, $limit = 10, $paginate = 10, $sort_by = 'date', $order_by = 'DESC') {
        return $model->find($type)->portfolios()->limit($limit)->orderBy($sort_by, $order_by)->paginate($paginate);
    }
}
