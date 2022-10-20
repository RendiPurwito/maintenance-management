@extends('layouts.app')

@section('css')
{{-- <link rel="stylesheet" href="assets/css/bootstrap.css"> --}}
{{-- <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css"> --}}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-2">
                    <h5 class="fw-bold">User</h5>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group" role="group" aria-label="Third group">
                            <a href="/admin/user/create" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus-circle"></i> Create User
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th >ID</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Alamat</th>
                                        <th data-sortable="false">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $index => $user)
                                    <tr>
                                        <td>
                                            {{ $index + $users->firstItem() }}
                                        </td>
                                        <td>
                                            <a href="" class="text-secondary">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $user->role}}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_telepon }}</td>
                                        <td>{{ $user->alamat }}</td>
                                        <td>
                                            <a href="/admin/user/{{ $user->id }}/edit" class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm"
                                                onclick="confirmDel({{$user->id}})" data-name="user" id="deleteButton">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div>{{ $users->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('javascript')
{{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script> --}}
{{-- <script src="/template/dist/assets/js/vendors.js"></script> --}}
@endsection