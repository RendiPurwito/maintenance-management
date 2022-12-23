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

        if($request->has('view_deleted'))
        {
            $users = User::onlyTrashed()->get();
        }
        return view('admin.user.index', compact('users'));
    }

    // public function pdf()
    // {
    //     $users = User::all();
    //     view()->share('users', $users);
    //     $pdf = PDF::loadview('admin.user.pdf');  
    //     return $pdf->stream();
    // }

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
            'phone_number' => 'required',
            'password' => 'required',
            'address' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password = Hash::make($request->password);
        $user->address = $request->address;
        $user->save();
        
        $notification = User::where('role', 'admin')->get();
        $notification->each->notify(new NewUserNotification($user));
        return redirect()->route('user')->with('success','User created successfully!');
    }

    public function edit($id){
        return view('admin.user.edit',[
            'user' => User::find($id),
        ]);
    }

    public function update(Request $request, $id){
        $notification = User::where('role', 'admin')->get();
        $user = user::find($id);
        $this->validate($request,[
            'name' => ['required'],
            'role' => ['required'],
            'email' => ['required'],
            'phone_number' => ['required'],
            // 'password' => ['required'],
            'address' => ['required'],
        ]);

        $input = $request->all();
        $input['name'] = $request['name'];
        $input['role'] = $request['role'];
        $input['email'] = $request['email'];
        $input['phone_number'] = $request['phone_number'];
        // $input['password'] = Hash::make($request['password']);
        $input['address'] = $request['address'];
        $user->update($input);
        $notification->each->notify(new UpdateUserNotification($user));
        return redirect()->route('user')->with('success','User updated successfully!');
    }

    public function destroy($id){
        $user = User::where('id', $id)->firstOrFail();
        $notification = User::where('role', 'admin')->get();
        $user->delete();
        $notification->each->notify(new DeleteUserNotification($user));
        return redirect()->route('user')->with('success','User deleted successfully!');
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();

        return back()->with('success', 'User restored successfully');
    }  
    
    public function restore_all()
    {
        User::onlyTrashed()->restore();

        return back()->with('success', 'all User restored successfully');
    }
}
