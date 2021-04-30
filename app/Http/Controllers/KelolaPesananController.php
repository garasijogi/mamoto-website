<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class KelolaPesananController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(5);
        return view('admin.pesanan', compact('books'));
    }
    public function destroy($id){
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('admin.pesanan')->with('success', 'Data Pesanan Berhasil dihapus');
    }
    public function changeStatus($id){
        $book =  Book::find($id);
        $book->status = 1;
        $book->save();

        return redirect()->route('admin.pesanan')->with('success', 'Status Pesanan Berhasil diubah');
    }
}
