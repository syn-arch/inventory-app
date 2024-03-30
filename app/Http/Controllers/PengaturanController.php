<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        return view('pengaturan');
    }

    public function update_username(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        User::find(auth()->user()->id)->update([
            'name' => $request->name
        ]);

        session()->flash('message', 'Nama berhasil diubah');
        return redirect('/pengaturan');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);

        $user = User::find(auth()->user()->id);

        if (password_verify($request->old_password, $user->password)) {
            $user->update([
                'password' => bcrypt($request->new_password)
            ]);
            session()->flash('message', 'Password berhasil diubah');
            return redirect('/pengaturan');
        }else{
            session()->flash('error', 'Password lama salah');
            return redirect('/pengaturan');
        }

    }
}
