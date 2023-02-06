<?php

namespace App\Http\Controllers;

use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use jazmy\FormBuilder\Models\Form;
use Illuminate\Support\Facades\Hash;
use App\Notifications\NewUserNotification;
use App\Notifications\DeleteUserNotification;
use App\Notifications\UpdateUserNotification;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function dashboard(){
        $notifications = auth()->user()->unreadNotifications;
        $numberOfNotifications = auth()->user()->unreadNotifications->count();
        $form = Form::all();


        return view('admin.dashboard', compact('notifications','numberOfNotifications', 'form'));
    }

    public function markNotif(Request $request){
        auth()->user()
            ->unreadNotifications
            ->when($request->input('id'), function ($query) use ($request) {
                return $query->where('id', $request->input('id'));
            })
            ->markAsRead();

        return response()->noContent();
    }

    // User CRUD
    public function index(Request $request){
        $users = User::All()->sortBy('name');
        return view('admin.user.index', compact('users'));
    }

    public function create(){
        return view('admin.user.create',[
            'user' => User::all()
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name'  => 'required',
            'role'  => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $notification = User::where('role', 'admin')->get();
        $notification->each->notify(new NewUserNotification($user));
        return redirect()->route('user.index')->with('success','User created successfully!');
    }

    public function edit($id){
        return view('admin.user.edit',[
            'user' => User::find($id),
        ]);
    }

    public function update(Request $request, $id){
        $user = user::find($id);
        $this->validate($request,[
            'name' => ['required'],
            'role' => ['required'],
            'email' => ['required'],
        ]);
        
        $input = $request->all();
        $input['name'] = $request['name'];
        $input['role'] = $request['role'];
        $input['email'] = $request['email'];
        $user->update($input);
        $notification = User::where('role', 'admin')->get();
        $notification->each->notify(new UpdateUserNotification($user));
        return redirect()->route('user.index')->with('success','User updated successfully!');
    }

    public function destroy($id){
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
        $notification = User::where('role', 'admin')->get();
        $notification->each->notify(new DeleteUserNotification($user));
        return redirect()->route('user.index')->with('success','User deleted successfully!');
    }
}
