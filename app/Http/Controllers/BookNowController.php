<?php

namespace App\Http\Controllers;

use App\Book;
use App\Books_package;
use App\Contact;
use App\Portfolio_type;
use Illuminate\Http\Request;

class BookNowController extends Controller
{
    public function index()
    {
        // $events = Portfolio_type::get();

        // get package list
        $books_packages = Books_package::get()->toArray();
        $contact_wa = Contact::where('name', 'whatsapp')->first()->toArray();
        // ambil nama packagesnya
        foreach($books_packages as $k => $v) {
            $books_packages[$k]['name_product'] = Portfolio_type::where('id', $v['id'])->select('name')->first()->name;
        }

        return view('booknow', compact('books_packages', 'contact_wa'));
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:books',
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
            'note' => $request->note
        ]);
        session()->flash('books');
        return redirect('booksuccess');
    }
}
