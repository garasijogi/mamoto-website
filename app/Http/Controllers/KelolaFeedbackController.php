<?php

namespace App\Http\Controllers;

use App\Feedback;
use Illuminate\Http\Request;

class KelolaFeedbackController extends Controller
{
    public function index()
    {
        $feedbacks =  Feedback::get();
        return view('admin.feedback', compact('feedbacks'));
    }

    public function edit(Request $request, $id)
    {
        $data = $request->except('_method', '_token');

        $validatedData = $request->validate([
            'mempelai_pria' => 'required',
            'mempelai_wanita' => 'required',
            'kesan_pesan' => 'required',
            'kritik_saran' => 'required',
        ]);

        $feedback = Feedback::find($id);
        $feedback->update($data);

        session()->flash('success', 'Feedback berhasil diubah');
        return redirect('admin/feedback');
    }

    public function delete($id)
    {
        Feedback::destroy($id);
        session()->flash('success', 'Feedback berhasil dihapus');
        return redirect('admin/feedback');
    }
}
