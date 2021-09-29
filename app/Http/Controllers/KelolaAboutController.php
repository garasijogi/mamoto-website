<?php

namespace App\Http\Controllers;

use App\Company_about;
use App\Http\Requests\AboutRequest;
use Illuminate\Http\Request;

class KelolaAboutController extends Controller
{
    public function index()
    {
        $about = Company_about::where('id', 0)->first();

        return view('admin.about', compact('about'));
    }

    public function edit(AboutRequest $request)
    {
        // retrieve data dari request
        $attr = $request->all();

        $company_about = Company_about::find(false);
        $company_about->post = $attr['post'];
        $company_about->save();
        return $company_about;

    }
}
