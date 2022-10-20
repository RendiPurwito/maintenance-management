@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header mb-2">
            <h4 class="fw-bold">Edit User</h4>
        </div>
        <div class="card-body">
            <form action="/admin/user/{{ $user->id }}" method="POST" id="editForm">
                @csrf
                <div class="mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" autocomplete="off" value="{{$user->name}}">
                </div>
    
                <div class="mb-4 d-flex flex-column">
                    <label for="role" class="form-label">Role</label>
                    <select name="role">
                        <option selected>{{$user->role}}</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
    
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="{{$user->email}}">
                </div>
    
                <div class="mb-4">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="number" class="form-control" id="no_telepon" name="no_telepon" autocomplete="off" value="{{$user->no_telepon}}">
                </div>
    
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password" autocomplete="off" value="{{$user->password}}">
                </div>
    
                <div class="mb-4">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" style="height: 70px">{{$user->alamat}}</textarea>
                </div>
    
                <button type="submit" class="btn btn-primary float-end" id="submitEditButton">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection