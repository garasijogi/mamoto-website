<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Setting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
	public function index(Contact $contact)
	{
		$contact_list = $contact->getContacts();
		$contact_instagram = $contact_list['contact_instagram'];
		$contacts = $contact_list['contacts_processed'];
		return view('contact', compact('contact_instagram', 'contacts')); 
	}
}
