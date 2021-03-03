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
        if($formData['input_name'] == 'contact' || $formData['input_name'] == 'text' || $formData['input_name'] == 'link'){
            // successfull validation
        } else {
            return response()->json('forbidden', 403);
        }
        $validator = Validator::make($formData, [
            'id' => 'required',
            'input_name' => 'required',
            'value' => 'required',
        ]);
        if($validator->fails()){
			return response()->json($validator->errors(), 422);
        } else {
            $contact->where('name', $formData['id'])->update([
                $formData['input_name'] => $formData['value']
            ]);

            return response()->json('success');
        }
    }
}
