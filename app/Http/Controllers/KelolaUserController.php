<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class KelolaUserController extends Controller
{
    public function index()
    {
        return view('admin.user', ['users' => User::limit(10)->get()]);
    }

    public function create()
    {
        return view('admin.createuser');
    }

    public function store(UserRequest $request)
    {
        // save data to attribute
        $attr = $request->all();
        $attr['role_id'] = 2;
        $attr['password'] = Hash::make($attr['password']);
        //create new user
        auth()->user()->create($attr);
        // flash message
        session()->flash('success', 'User berhasil ditambah');
        //return back
        return redirect('admin/user');
    }

    public function edit(User $user)
    {
        return view('admin.createuser', [
            'user' => $user,
            'submit' => 'Simpan'
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $this->authorize('update', $user);
        //assign request to attr
        $attr = $request->all();
        $attr['password'] = Hash::make($attr['password']);
        //update the user
        $user->update($attr);
        //flash message
        session()->flash('success', 'Data user telah diperbarui');
        //return back
        return redirect('admin/user');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        session()->flash('error', 'User telah dihapus');
        return redirect('admin/user');
    }
}
