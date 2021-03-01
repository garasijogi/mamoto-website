<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KelolaContactController extends Controller
{
    public function index(Contact $contact)
    {
        $lists = $contact->get();
        return view('admin.contact', compact('lists'));
    }

    protected function save(Request $request, Contact $contact)
    {
        $formData = $request->all();
        // validasi
        $validator = Validator::make($formData,[
            'contact' => 'required'
        ]);
        if($validator->fails()){
			return response()->json($validator->errors(), 422);
        } else {
            $contact->where('name', $formData['id'])->update([
                'contact' => $formData['contact']
            ]);

            return response()->json('success');
        }
    }
}
