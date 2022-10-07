@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="/template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
@endsection

@section('content')
<div class="container">
    <div class="row" id="table-hover-row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3 class="card-title">User</h3>
                    <a href="/admin/user/create" class="btn btn-primary btn-sm float-right">
                        <i class="fa fa-plus-circle"></i> Create User
                    </a>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" id="table1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                        {{-- <th>Password</th> --}}
                                        <th>No Telepon</th>
                                        <th>Alamat</th>
                                        <th data-sortable="false">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            {{ $loop->iteration }}
                                        </td>
                                        <td>
                                            <a href="" class="text-secondary">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $user->role}}</td>
                                        <td>{{ $user->email }}</td>
                                        {{-- <td>{{ $user->password}}</td> --}}
                                        <td>{{ $user->no_telepon }}</td>
                                        <td>{{ $user->alamat }}</td>
                                        <td>
                                            <a href="/admin/user/{{ $user->id }}/edit" class="btn btn-primary btn-sm">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger btn-sm" onclick="confirmDel({{$user->id}})" data-name="user" id="deleteButton">
                                            <i class="fa-solid fa-trash-can"></i>
                                            </a>
                                            {{-- <form id="delete-user" method="POST" action="/admin/user/delete/{{$user->id}}">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDel(event)"> 
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button> 
                                            </form> --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div>{{ $users->links() }}
                </div> --}}
            </div>
        </div>
        {{-- <div class="card">
                <div class="card-header d-flex">
                    <h4 class="flex-grow-1">Data User</h4>
                    <a href="/admin/user/create" class="btn btn-primary btn-md">Tambah +</a>
                </div>
                <div class="card-body">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-top">
                            <div class="dataTable-dropdown">
                                <select class="dataTable-selector form-select">
                                    <option value="5" selected="">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select>
                                <label>entries per page</label>
                            </div>
                            <div class="dataTable-search"><input class="dataTable-input" placeholder="Search..." type="text">
                            </div>
                        </div>
                        <div class="dataTable-container table table-responsive">
                            <table class="table table-hover dataTable-table" id="table1">
                                <thead>
                                    <tr>
                                        <th data-sortable="" style="width: 7%;">
                                            <a href="#" class="dataTable-sorter">ID
                                            </a>
                                        </th>
                                        <th data-sortable="" style="width: 17%;">
                                            <a href="#" class="dataTable-sorter">Name
                                            </a>
                                        </th>
                                        <th data-sortable="" style="width: 10%;">
                                            <a href="#" class="dataTable-sorter">Role
                                            </a>
                                        </th>
                                        <th data-sortable="" style="width: 16%;">
                                            <a href="#" class="dataTable-sorter">Email
                                            </a>
                                        </th>
                                        <th data-sortable="" style="width: 13.9854%;">
                                            <a href="#" class="dataTable-sorter">Password
                                            </a>
                                        </th>
                                        <th data-sortable="" style="width: 14.5%;">
                                            <a href="#" class="dataTable-sorter">No Telepon
                                            </a>
                                        </th>
                                        <th data-sortable="" style="width: 18%;">
                                            <a href="#" class="dataTable-sorter">Alamat
                                            </a>
                                        </th>
                                        <th style="width: 13.9854%;">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->role}}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->password}}</td>
        <td>{{ $user->no_telepon }}</td>
        <td>{{ $user->alamat }}</td>
        <td>
            <a href="/admin/user/{{ $user->id }}/edit" class="text-warning">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path
                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"
                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg>
            </a>
            <a href="/admin/user/{{ $user->id }}" class="text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash"
                    viewBox="0 0 16 16">
                    <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                    <path fill-rule="evenodd"
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                </svg>
            </a>
        </td>
        </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="dataTable-bottom">
        <div class="dataTable-info">Showing 1 to 10 of 26 entries</div>
        <ul class="pagination pagination-primary float-right dataTable-pagination">
            <li class="page-item pager"><a href="#" class="page-link" data-page="1">‹</a></li>
            <li class="page-item active"><a href="#" class="page-link" data-page="1">1</a></li>
            <li class="page-item"><a href="#" class="page-link" data-page="2">2</a></li>
            <li class="page-item"><a href="#" class="page-link" data-page="3">3</a></li>
            <li class="page-item pager"><a href="#" class="page-link" data-page="2">›</a></li>
        </ul>
    </div>
</div>
</div>
</div> --}}
</div>
</div>
</div>
@endsection

@section('javascript')
<script src="/template/dist/assets/js/feather-icons/feather.min.js"></script>
<script src="/template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="/template/dist/assets/js/vendors.js"></script>
@endsection