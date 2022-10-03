<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('admin.user.index',[
            'users' => User::paginate(10),
        ]);
    }

    public function create(){
        return view('admin.user.create',[
            'user' => User::all()
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
            'no_telepon' => 'required',
            'password' => 'required',
            'alamat' => 'required',
        ]);
        User::create($request->all());
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
        return redirect()->route('user')->with('edit','Data berhasil di Ubah!');
    }

    public function destroy($id){
        $user = user::find($id);
        $user->delete();
        return redirect()->route('user')->with('delete','Data berhasil di Hapus!');
    }

    
}
