<?php

namespace App\Http\Controllers;

class PricelistController extends Controller
{
    public function index()
    {
      $file= public_path(). "/pdf/pricelist.pdf";

      $headers = array('Content-Type: application/pdf');
  
      return response()->download($file, 'mamotopicture-pricelist.pdf', $headers);
    }
}
