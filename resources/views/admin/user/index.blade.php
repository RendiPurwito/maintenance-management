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
                    <h5 class="fw-bold">Users</h5>
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
                            {{-- <form>
                                Show
                                <select id="pagination">
                                    <option value="5" @if($page == 5) selected @endif >5</option>
                                    <option value="10" @if($page == 10) selected @endif >10</option>
                                    <option value="25" @if($page == 25) selected @endif >25</option>
                                </select>
                                Entries
                            </form> --}}
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
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
                                        <td>{{ $user->no_telepon }}</td>
                                        <td>{{ $user->alamat }}</td>
                                        <td class="">
                                            <a href="/admin/user/{{ $user->id }}/edit"
                                                class="btn btn-primary btn-sm mb-1">
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
                    {{-- <div class="card-footer px-4">
                        @if ($users->hasPages())
                        <div>{{ $users->links('vendor.pagination.bootstrap-5') }}</div>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('javascript')
{{-- <script>
    $(document).ready(function () {
        $('#table').DataTable({
            dom: 'Blfrtip',
            info: true,
            paging: true,
            pageLength: 10,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All'],
            ],
            pagingType: 'full_numbers',
        });
    });
</script> --}}
{{-- <script>
    document.getElementById('pagination').onchange = function() { 
        window.location = "{!! $members->url(1) !!}&items=" + this.value; 
    }; 
</script> --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script> --}}
{{-- <script src="/template/dist/assets/js/vendors.js"></script> --}}
@endsection