<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class KelolaPesananController extends Controller
{
    public function index()
    {
        $books = Book::get();
        return view('admin.pesanan', compact('books'));
    }
}
