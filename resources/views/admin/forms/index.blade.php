@extends('formbuilder::layout')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between ">
        <h5 class="fw-bold">
            Forms
        </h5>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group" role="group" aria-label="Third group">
                <a href="/admin/form/pdf" class="btn btn-primary btn-sm" title="Export To PDF" target="_blank">
                    <i class="fa-solid fa-file-pdf"></i>
                </a>

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
            @if($forms->count())
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
                </table>
            </div>
            @else  
            <h4 class="text-danger text-center">
                No form to display.
            </h4>
            @endif
        </div>
        {{-- <div class="card-footer px-4">
            @if($forms->hasPages())
                <div>{{ $forms->links('vendor.pagination.bootstrap-5') }}</div>
            @endif
        </div> --}}
    </div>
</div>
<div class="col-12">
</div>

@endsection
