@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="fw-bold">Tambah User</h4>
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
                    <option selected> Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
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
                <label for="no_telepon" class="form-label">No Telepon</label>
                <input type="number" class="form-control" id="no_telepon" name="no_telepon" autocomplete="off">
                @error('no_telepon')
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
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" style="height: 70px"></textarea>
                @error('alamat')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
    </div>
</div>
@endsection