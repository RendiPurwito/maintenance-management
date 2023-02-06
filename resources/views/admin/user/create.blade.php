@extends('layouts.app')
@section('css')
<style>
    @media screen and (max-width: 640px) {
        #main .main-content {
            padding: 1rem 1rem;
        }

        .container-fluid{
            padding: 0;
        }

        .card-body{
            padding: 0.5rem;
        }

        option{
            font-size: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title fw-bold">Add User</h5>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group" role="group" aria-label="Third group">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="/admin/user" method="POST" id="myForm">
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
                            <select name="role" class="selectpicker">
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
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password" autocomplete="off">
                            @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="btn-footer float-end">
                        <a href="/admin/user" class="btn btn-danger me-1 cancel-button">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary float-end" id="submitButton">Submit</button>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
