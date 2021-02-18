<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class KelolaPromoController extends Controller
{
    public function index()
    {
        return view('admin.promo');
    }

    public function add(Request $request)
    {
        $formData = $request->all();
        $validator = Validator::make($formData, [
            'name' => 'required|min:8',
            'post' => 'required|min:12',
            'link' => 'required',
            'photo' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        } else {
            $this->save_newPromo($formData);
        }
    }
    
    protected function save_newPromo($formData)
    {
        // buat id
        // simpan ke database
        
        // response sebagai oke
        return response();
    }
}
