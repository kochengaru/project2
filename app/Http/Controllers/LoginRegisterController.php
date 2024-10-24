<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Buku;
use App\Models\Peminjaman;

class LoginRegisterController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register'); 
    }

    // ubah menjadi pengguna biasa
    public function userHome(Request $request) 
    {
    $search = $request->input('search'); 
    $data = Buku::where(function($query) use ($search) {
        $query->where('judul_buku', 'LIKE', '%' . $search . '%');
    })->paginate(5);

    return view('user.home', compact('data'));
    }


    public function adminHome(Request $request)
    {
        $search = $request->input('search');

        $data = User::where('level', 'admin')
            ->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->paginate(5);

        return view('admin.home', compact('data'));
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns',
            'jenis_kelamin' => 'required',
            'password' => 'required|min:8|max:20|confirmed'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($user) {
            return redirect()->route('auth.login')->with('success', 'Akun Berhasil dibuat, silahkan login!');
        } else {
            return back()->with('failed', 'Maaf, terjadi kesalahan, coba lagi!');
        }
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email:dns'],
            'password' => ['required', 'min:8', 'max:20']
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();
            if ($user->level == 'user') {
                return redirect('/user/home');
            } else {
                return redirect('/admin/home');
            }
        }

        return back()->with('failed', 'Maaf, terjadi kesalahan, coba kembali beberapa saat!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
