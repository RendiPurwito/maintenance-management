<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserNotification;

class LoginController extends Controller
{
    // Login
    public function login(){
        return view('auth.login');
    }

    public function authenticate(Request $request ){
        $credentials = $request->validate ([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            if(auth()->user()->role == 'admin'){
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }else{
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }
        }
        return back()->with('loginError', 'Login Gagal!');
    }

    // Log Out
    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }

    // Register
    public function register(){
        return view('auth.registration');
    }

    public function storeregister(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email|unique:users',
            'no_telepon' => 'required',
            'password' => 'required',
            'alamat' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->role = 'user';
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $user->save();
        $registration = User::first();
        #store notification info into notifications table
        $registration->notify(new NewUserNotification($user));
        // dd('user registered successfully, Notification send to Admin Successfully.');

        // dd($request->all());
        // User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => bcrypt($request->password),
        //     'role' => 'user',
        //     'no_telepon' => $request->no_telepon,
        //     'alamat' => $request->alamat,
        //     'remember_token' => Str::random(60)
        // ]);
        return redirect("/")->with('registerSuccess', 'Registrasi Berhasil');
    }
}
