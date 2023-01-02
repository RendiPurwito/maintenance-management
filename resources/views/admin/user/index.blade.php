@extends('layouts.app')

@section('css')
{{--! Datatable CSS CDN --}}
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css"> --}}
<style>
    @media screen and (min-width: 360px) {
        #main .main-content {
            padding: 1rem 1rem;
        }
    }
</style>
@endsection

@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
</div> --}}
@if (Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}")
    </script>
@endif
<div class="card">
    <div class="card-header d-flex justify-content-between mb-2">
        <h5 class="fw-bold">Users</h5>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group" role="group" aria-label="Third group">
                {{-- <a href="/admin/user/pdf" class="btn btn-primary btn-sm" title="Export To PDF" target="_blank">
                    <i class="fa-solid fa-file-pdf"></i>
                </a> --}}
                @if(request()->has('view_deleted'))
                    <a href="{{ route('user.index') }}" class="btn btn-primary btn-sm">View All User</a>
                    <a href="{{ route('user.restore_all') }}" class="btn btn-primary btn-sm">Restore All</a>
                @else
                    <a href="{{ route('user.index', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary btn-sm">View Deleted User</a>
                @endif
                <a href="/admin/user/create" class="btn btn-primary btn-sm" title="Add a New User">
                    <i class="fa fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body">
            <div class="table-wrapper">
                <table class="table table-striped" id="table">
                    <thead>
                        <tr>
                            {{-- <th class="five">#</th> --}}
                            <th class="five">#</th>
                            <th class="twenty-five">Name</th>
                            <th class="twenty-five">Role</th>
                            {{-- <th class="twenty-five">Email</th>
                            <th class="twenty-five">Phone Number</th>
                            <th class="twenty-five">Address</th> --}}
                            <th data-sortable="false" class="five">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>{{ $user->role}}</td>
                            {{-- <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->address }}</td> --}}
                            <td>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#detailUserModal-{{$user->id}}" title="View detail for user '{{$user->name}}'">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <a href="/admin/user/{{ $user->id }}/edit" class="btn btn-primary btn-sm"
                                    title="Edit user '{{ $user->name }}'">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                {{-- <a href="#" class="btn btn-danger btn-sm"
                                    onclick="confirmDel({{$user->id}})" data-name="user" data-message="Delete user
                                '{{ $user->name }}'?" id="deleteButton" title="Delete user '{{ $user->name }}'">
                                <i class="fa-solid fa-trash-can"></i>
                                </a> --}}
                                @if(request()->has('view_deleted'))
                                    <a href="{{ route('user.restore', $user->id) }}" class="btn btn-success btn-sm">Restore</a>
                                @else
                                    <form action="{{ route('delUser', $user) }}" method="POST" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm" id="deleteButton"
                                            data-message="Delete user '{{ $user->name }}' ?"
                                            title="Delete user '{{ $user->name }}'">
                                            <i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- <div class="card-footer px-4">
            <div>{{ $users->links('vendor.pagination.bootstrap-5') }}
    </div>
</div> --}}
</div>
</div>

@foreach ($users as $user)
<div class="modal fade" id="detailUserModal-{{$user->id}}" tabindex="-1" 
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            {{-- <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> --}}
            <div class="modal-body">
                <strong>Name </strong> <span>: {{ $user->name }}</span>
                <br>
                <hr>
                <strong>Role </strong> <span>: {{ $user->role }}</span>
                <br>
                <hr>
                <strong>Email </strong> <span>: {{ $user->email }}</span>
                <br>
                <hr>
                <strong>Phone Number </strong> <span>: {{ $user->phone_number }}</span>
                <br>
                <hr>
                <strong>Address </strong> <span>: {{ $user->address }}</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('javascript')
{{-- <script>
    function showModal() {
        $('#detailUserModal').modal('show');
    }
</script> --}}
{{--! DataTables & Plugins --}}
{{-- <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> --}}

{{--! Adminlte JS  --}}
{{-- <script src="/adminlte/js/adminlte.js"></script> --}}

{{--! Datatables CDN --}}
{{-- <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script> --}}
@endsection