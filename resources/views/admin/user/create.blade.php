@extends('layouts.app')

@section('content')
{{-- <div class="container">
</div> --}}
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="card-title fw-bold">Add User</h5>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group" role="group" aria-label="Third group">
                <a href="/admin/user" class="btn btn-sm btn-primary float-md-right" title="Back To Users">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="/admin/user" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" autocomplete="off">
                @error('name')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4 d-flex flex-column">
                <label for="role" class="form-label">Role</label>
                <select name="role">
                    <option selected>Select Role</option>
                    <option value="admin">Admin</option>
                    <option value="field_support">Field Support</option>
                </select>
            </div>

            <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" autocomplete="off">
                @error('email')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="number" class="form-control" id="phone_number" name="phone_number" autocomplete="off">
                @error('phone_number')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password" name="password" autocomplete="off">
                @error('password')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" style="height: 70px"></textarea>
                @error('address')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary float-end" id="submitButton">Submit</button>
        </form>
    </div>
</div>
@endsection
