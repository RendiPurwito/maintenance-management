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
            padding: 0.5rem
        }
        
        select{
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            padding: 0.25rem
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
                    <h5 class="card-title fw-bold">Edit User</h5>
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
                    </form>
                </div>
                <div class="card-footer">
                    <div class="btn-footer float-end">
                        <a href="/admin/user" class="btn btn-danger me-1 cancel-button">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary" id="submitEditButton">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection