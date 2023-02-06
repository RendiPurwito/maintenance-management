@extends('formbuilder::layout')

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
    }
</style>
@endsection

@section('content')
@if (Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}")
    </script>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between ">
                    <h5 class="fw-bold">
                        Forms
                    </h5>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group" role="group" aria-label="Third group">
                            <a href="{{ route('formbuilder::forms.create') }}" class="btn btn-primary btn-sm" title="Add a New Form">
                                <i class="fa fa-plus-circle"></i>
                            </a>
                            {{-- <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-th-list"></i> My Submissions
                            </a> --}}
                        </div>
                    </div>
                </div>
            
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table">
                                <thead>
                                    <tr>
                                        <th class="five">#</th>
                                        <th class="twenty-five">Name</th>
                                        <th>Allows Edit?</th>
                                        <th class="ten">Submissions</th>
                                        <th class="twenty-five">Created On</th>
                                        <th class="twenty-five" data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($forms as $form)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $form->name }}</td>
                                            <td>{{ $form->allowsEdit() ? 'YES' : 'NO' }}</td>
                                            <td>{{ $form->submissions_count }}</td>
                                            <td>{{ $form->created_at->toDayDateTimeString() }}</td>
                                            <td>
                                                <a href="{{ route('formbuilder::forms.submissions.index', $form) }}" class="btn btn-primary btn-sm" title="View submissions for form '{{ $form->name }}'">
                                                    <i class="fa fa-th-list"></i>
                                                </a>
                                                <a href="{{ route('formbuilder::forms.show', $form) }}" class="btn btn-primary btn-sm" title="Preview form '{{ $form->name }}'">
                                                    <i class="fa fa-eye"></i> 
                                                </a> 
                                                <a href="{{ route('formbuilder::forms.edit', $form) }}" class="btn btn-primary btn-sm" title="Edit form '{{ $form->name }}'">
                                                    <i class="fa fa-pencil"></i> 
                                                </a> 
                                                <form action="{{ route('formbuilder::forms.destroy', $form) }}" method="POST" id="deleteFormForm_{{ $form->id }}" class="d-inline-block">
                                                    @csrf 
                                                    @method('DELETE')
            
                                                    <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteFormForm_{{ $form->id }}" data-message="Delete form '{{ $form->name }}'?" title="Delete form '{{ $form->name }}'">
                                                        <i class="fa fa-trash-o"></i> 
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
