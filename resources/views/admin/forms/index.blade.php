@extends('formbuilder::layout')

@section('content')
{{-- <div class="col-12">
</div> --}}
@if (Session::has('success'))
    <script>
        toastr.success("{!! Session::get('success') !!}")
    </script>
@endif
<div class="card">
    <div class="card-header d-flex justify-content-between ">
        <h5 class="fw-bold">
            Forms
        </h5>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group" role="group" aria-label="Third group">
                {{-- <a href="/admin/form/pdf" class="btn btn-primary btn-sm" title="Export To PDF" target="_blank">
                    <i class="fa-solid fa-file-pdf"></i>
                </a> --}}
                @if(request()->has('view_deleted'))
                    <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-primary btn-sm">View All Form</a>
                    <a href="{{ route('form.restore_all') }}" class="btn btn-primary btn-sm">Restore All</a>
                @else
                    <a href="{{ route('formbuilder::forms.index', ['view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary btn-sm">View Deleted Form</a>
                @endif

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
                            {{-- <th class="ten">Visibility</th> --}}
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
                                {{-- <td>{{ $form->visibility }}</td> --}}
                                <td>{{ $form->allowsEdit() ? 'YES' : 'NO' }}</td>
                                <td>{{ $form->submissions_count }}</td>
                                <td>{{ $form->created_at->toDayDateTimeString() }}</td>
                                <td>
                                    @if(request()->has('view_deleted'))
                                        <a href="{{ route('form.restore', $form->id) }}" class="btn btn-success btn-sm">Restore</a>
                                    @else
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
                                    @endif
                                    {{-- <a href="#" class="btn btn-primary btn-sm show-btn">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </a>
                                    <div style="display: none;" class="mt-1 action-btn" >
                                        <a href="{{ route('formbuilder::forms.submissions.index', $form) }}" class="btn btn-primary btn-sm" title="View submissions for form '{{ $form->name }}'">
                                            <i class="fa fa-th-list"></i>
                                        </a>
                                        <a href="{{ route('formbuilder::forms.show', $form) }}" class="btn btn-primary btn-sm" title="Preview form '{{ $form->name }}'">
                                            <i class="fa fa-eye"></i> 
                                        </a> 
                                        <a href="{{ route('formbuilder::forms.edit', $form) }}" class="btn btn-primary btn-sm" title="Edit form">
                                            <i class="fa fa-pencil"></i> 
                                        </a> 
                                        <button class="btn btn-primary btn-sm clipboard" data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}" data-message="" data-original="" title="Copy form URL to clipboard">
                                            <i class="fa fa-clipboard"></i> 
                                        </button> 
    
                                        <form action="{{ route('formbuilder::forms.destroy', $form) }}" method="POST" id="deleteFormForm_{{ $form->id }}" class="d-inline-block">
                                            @csrf 
                                            @method('DELETE')
    
                                            <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteFormForm_{{ $form->id }}" data-message="Delete form '{{ $form->name }}'?" title="Delete form '{{ $form->name }}'">
                                                <i class="fa fa-trash-o"></i> 
                                            </button>
                                        </form>
                                    </div> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- @if($forms->count())
                    @else  
                    <h4 class="text-danger text-center">
                        There is no form available 
                    </h4>
                    @endif --}}
                </table>
            </div>
        </div>
        {{-- <div class="card-footer px-4">
            @if($forms->hasPages())
                <div>{{ $forms->links('vendor.pagination.bootstrap-5') }}</div>
            @endif
        </div> --}}
    </div>
</div>


@endsection
