<?php

namespace App\Http\Controllers;

use App\Book;
use App\Portfolio_type;
use Illuminate\Http\Request;

class BookNowController extends Controller
{
    public function index()
    {
        $events = Portfolio_type::get();
        return view('booknow', compact('events'));
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
        ]);
        $book = Book::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'events' => json_encode($request->event),
            'booking_date' => $request->booking_date,
            'location' => $request->location,
            'note' => $request->note,
            'status' => 0
        ]);
        session()->flash('books');
        return redirect('booksuccess');
    }
}
