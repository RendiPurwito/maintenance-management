<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        $notifications = auth()->user()->unreadNotifications;

        return view('admin.dashboard', compact('notifications'));
    }

    public function mark(Request $request){
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    // User CRUD
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
