<?php

namespace App\Http\View\Composers;

use App\Contact;
use App\Promo;
use App\Setting;
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
        'bridestory' => Contact::where('name', 'bridestory')->first(),
        'facebook' => Contact::where('name', 'facebook')->first()
      ];
      // ambil text pemesanan dari setting
      $this->whatsapp->text = urlencode(Setting::where('setting_name', 'contactFloatingButton_text')->first()->setting_value);
      $this->promos_count = Promo::get()->count();
    }

    public function compose(View $view)
    {
      $view->with( 'whatsapp', $this->whatsapp)->with('promos_count', $this->promos_count)->with('socmed', $this->socmed);
    }
}
