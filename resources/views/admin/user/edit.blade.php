@extends('layouts.app')

@section('content')
<div class="container">
</div>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="card-title fw-bold">Edit User</h5>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group" role="group" aria-label="Third group">
                <a href="/admin/user" class="btn btn-sm btn-primary float-md-right" title="Back To Users">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
        </div>
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
                    <option value="field_support">Field Support</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" autocomplete="off" value="{{$user->email}}">
            </div>

            <div class="mb-4">
                <label for="no_telepon" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="no_telepon" name="no_telepon" autocomplete="off" value="{{$user->no_telepon}}">
            </div>

            {{-- <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" autocomplete="off" value="{{$user->password}}">
            </div> --}}

            <div class="mb-4">
                <label for="alamat" class="form-label">Address</label>
                <textarea class="form-control" id="alamat" name="alamat" style="height: 70px">{{$user->alamat}}</textarea>
            </div>

            <button type="submit" class="btn btn-primary float-end" id="submitEditButton">Submit</button>
        </form>
    </div>
</div>
@endsection