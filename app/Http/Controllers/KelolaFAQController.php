<?php

namespace App\Http\Controllers;

use App\Faq;
use Illuminate\Http\Request;

class KelolaFAQController extends Controller
{
    public function index()
    {
        $faqs = Faq::get();
        return view('admin.faq', compact('faqs'));
    }
    public function create(){
        return view('admin.createfaq');
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'question' => 'required', 
            'answer' => 'required' 
        ],
        [
            'question.required' => 'Kolom :attribute harus diisi',
            'answer.required' => 'Kolom :attribute harus diisi',
        ]
        );
        Faq::Create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);
        session()->flash('success', 'FAQ berhasil ditambah');
        return redirect('admin/faq');
    }
    
    public function edit($id){
        $faq = Faq::find($id);
        return view('admin.editfaq', compact('faq'));
    }
    public function update(Request $request, $id){
        $data = $request->except('_method','_token');
        $validatedData = $request->validate(
        [
            'question' => 'required',
            'answer' => 'required'
        ],
        [
            'question.required' => 'Kolom :attribute harus diisi',
            'answer.required' => 'Kolom :attribute harus diisi',
            ]
        );
        $faqs = Faq::find($id);
        $faqs->update($data);
        
        session()->flash('success', 'FAQ berhasil diubah');
        return redirect('admin/faq');
    }
    
    public function destroy($id){
        Faq::destroy($id);
        session()->flash('success', 'FAQ berhasil dihapus');
        return redirect('admin/faq');
    }
}
