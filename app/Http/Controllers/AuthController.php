<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewUserNotification;

class AuthController extends Controller
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
        $user->role = 'field_support';
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $user->save();
        $notification = User::first();
        #store notification info into notifications table
        $notification->notify(new NewUserNotification($user));
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

    public function showForgetPasswordForm()
    {
        return view('auth.forget-password');
    }

    private function generateToken()
    {
        $key = config('app.key');
        
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        return hash_hmac('sha256', Str::random(40), $key);
    }

    public function submitForgetPasswordForm(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        $generateToken = $this->generateToken();
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $generateToken,
            'created_at' => Carbon::now()
        ]);
        $token = DB::table('password_resets')->where('token', $generateToken)->first();
        Mail::to($user->email)->send(new ResetPasswordMail($user,$token->token));
        return redirect()->back()->with("message","Your reset link is being sent to your email");
    }

    public function showResetPasswordForm($token) { 
 
        $buttonReset = DB::table('password_resets')->where('token',$token)->first();
        if(!$buttonReset || Carbon::now()->subMinutes(10) > $buttonReset->created_at){
            // $buttonReset->delete();
            return redirect()->route('forget.password.get')->with('error','Invalid password reset link or link expired.');
        }else{
            return view('auth.reset-password',[
                'token' => $token
            ]);
        }
        
    }

    public function submitResetPasswordForm($token, Request $request)
    {
        $buttonReset = DB::table('password_resets')->where('token',$token)->first();
        if(!$buttonReset || Carbon::now()->subMinutes(10) > $buttonReset->created_at){
            return redirect()->route('forget.password.get')->with('error','Invalid password reset link or link expired.');
        }else{
            if(strcmp($request->get('confirm_password'), $request->get('new_password'))){
                return redirect()->back()->with("error","Your confirm password does not matches with your new password. Please try again.");
            }
    
            $tokens = DB::table('password_resets')->where('token',$token);
            $reset_password = $tokens->first();
            $user = User::all()->where('email', $reset_password->email)->first();

            if($user->email != $request->get('email')){
                return redirect()->back()->with("error","Enter your correct email.");
            }else{
                $tokens->delete();
                $user->update([
                    'password' => bcrypt($request->new_password)
                ]);
                return redirect('/')->with("success","Password changed successfully!");
            }
        }
    }
}
