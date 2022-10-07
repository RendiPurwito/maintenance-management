<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.user.index',[
            'users' => User::paginate(5),
        ]);
    }

    public function create(){
        return view('admin.user.create',[
            'user' => User::all()
        ]);
    }

    public function store(Request $request){
        $validatedData = $this->validate($request,[
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'password' => 'required',
            'alamat' => 'required',
        ]);
        $validatedData['password'] = bcrypt($validatedData['password']);
        User::create($validatedData);
        return redirect()->route('user')->with('success','Data berhasil di Tambah!');
    }

    public function edit($id){
        return view('admin.user.edit',[
            'user' => User::find($id),
        ]);
    }

    public function update(Request $request, $id){
        $validasi = $this->validate($request,[
            'name' => ['required'],
            'role' => ['required'],
            'email' => ['required'],
            'no_telepon' => ['required'],
            'password' => ['required'],
            'alamat' => ['required'],
        ]);
        User::where('id',$id)->update($validasi);
        return redirect()->route('user')->with('success','Data berhasil di Ubah!');
    }

    public function destroy($id){
        $user = user::find($id);
        $user->delete();
        return redirect()->route('user')->with('success','User deleted successfully!');
    }

    
}
