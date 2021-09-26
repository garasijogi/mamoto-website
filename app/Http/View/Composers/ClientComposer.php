<?php

namespace App\Http\View\Composers;

use App\Contact;
use App\Promo;
use Illuminate\View\View;

class ClientComposer
{
    public function __construct()
    {
      $this->whatsapp = Contact::where('name', 'whatsapp')->first();
      $this->socmed = [
        'instagram' => Contact::where('name', 'instagram')->first(),
        'youtube' => Contact::where('name', 'youtube')->first(),
        'email' => Contact::where('name', 'email')->first(),
        'bridestory' => Contact::where('name', 'instagram')->first(),
        'facebook' => Contact::where('name', 'facebook')->first()
      ];

      $this->promos_count = Promo::get()->count();
    }

    public function compose(View $view)
    {
      $view->with( 'whatsapp', $this->whatsapp)->with('promos_count', $this->promos_count)->with('socmed', $this->socmed);
    }
}