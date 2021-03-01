<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class KelolaContactController extends Controller
{
    public function index(Contact $contact)
    {
        $lists = $contact->get();
        return view('admin.contact', compact('lists'));
    }
}
