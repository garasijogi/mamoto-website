<?php

namespace App\Http\View\Composers;

use App\Contact;
use Illuminate\View\View;

class ClientComposer
{
    public function __construct()
    {
      $whatsapp = Contact::where('name', 'whatsapp')->first();

      $this->whatsapp = $whatsapp;
    }

    public function compose(View $view)
    {
      $view->with( 'whatsapp', $this->whatsapp);
    }
}