<?php

namespace App\Http\Controllers;

use App\Book;
use App\Portfolio_type;
use Illuminate\Http\Request;

class KelolaPesananController extends Controller
{
    public function index()
    {
        $events = Portfolio_type::get();
        $books = Book::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.pesanan', compact('books', 'events'));
    }
    public function edit(Request $request, $id)
    {
        $data = $request->except('_method', '_token');
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'location' => 'required',
        ]);

        $pesanan = Book::find($id);
        $pesanan->update($data);

        session()->flash('success', 'Pesanan berhasil diubah');
        return redirect('admin/pesanan');
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('admin.pesanan')->with('success', 'Data Pesanan Berhasil dihapus');
    }
    public function changeStatus($id)
    {
        $book =  Book::find($id);
        $book->status = 1;
        $book->save();

        return redirect()->route('admin.pesanan')->with('success', 'Status Pesanan Berhasil diubah');
    }
}
