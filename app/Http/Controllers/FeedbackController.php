<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index(){
        return view('feedback');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'mempelai_pria' => 'required',
            'mempelai_wanita' => 'required',
            'kesan_pesan' => 'required',
            'kritik_saran' => 'required',
        ]);
        $feedback = Feedback::create([
            'mempelai_pria' => $request->mempelai_pria,
            'mempelai_wanita' => $request->mempelai_wanita,
            'kesan_pesan' => $request->kesan_pesan,
            'kritik_saran' => $request->kritik_saran,
        ]);
        session()->flash('success', 'Terimakasih telah Memberikan testimoni kepada Mamoto Picture.');
        return redirect('feedback');
    }
}
