<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('dashboard-siswa');
        }
        return view('auth.Login-form');
    }

    public function login(Request $request)
    {
        $request->validate([
            "nis_nip"=> "required",
            "password"=> "required"
            ]);

            $user = $request->user();
            $user = User::where('nip_nis', $request->nip_nis)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('dashboard-siswa');
        }

        return back()->withErrors(['nip_nis' => 'NIP/NIS atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
         Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function createSiswa(Request $request)
    {
       return view('admin.Create-siswa');
    }

    public function storeSiswa(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'nip_nis'  => 'required|unique:users,nip_nis',
            'kelas'    => 'required|in:X,XI,XII',
            'password' => 'required|min:6|confirmed',
            ]);

        User::create([
            'nama'=> $request->nama,
            'nip_nis'=> $request->nip_nis,
            'kelas'=> $request->kelas,
            'password'=> Hash::make($request->password),
            'role'=>'siswa',
        ]);

        return redirect()->back()->with('succes','akun siswa berhasil di buat');
    }

}
