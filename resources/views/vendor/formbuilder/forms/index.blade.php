@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-3">
                    <h5 class="fw-bold">
                        Forms
                    </h5>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group" role="group" aria-label="Third group">
                            <a href="{{ route('formbuilder::forms.create') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus-circle"></i> Create a New Form
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
                            <table class="table table-hover" id="table">
                                <thead>
                                    <tr>
                                        <th class="five">#</th>
                                        <th>Name</th>
                                        <th class="ten">Visibility</th>
                                        <th class="fifteen">Allows Edit?</th>
                                        <th class="ten">Submissions</th>
                                        <th class="twenty-five" data-sortable="false">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($forms as $index => $form)
                                        <tr>
                                            <td>{{ $index + $forms->firstItem() }}</td>
                                            <td>{{ $form->name }}</td>
                                            <td>{{ $form->visibility }}</td>
                                            <td>{{ $form->allowsEdit() ? 'YES' : 'NO' }}</td>
                                            <td>{{ $form->submissions_count }}</td>
                                            <td>
                                                <a href="{{ route('formbuilder::forms.submissions.index', $form) }}" class="btn btn-primary btn-sm" title="View submissions for form '{{ $form->name }}'">
                                                    <i class="fa fa-th-list"></i> Data
                                                </a>
                                                <a href="{{ route('formbuilder::forms.show', $form) }}" class="btn btn-primary btn-sm" title="Preview form '{{ $form->name }}'">
                                                    <i class="fa fa-eye"></i> 
                                                </a> 
                                                <a href="{{ route('formbuilder::forms.edit', $form) }}" class="btn btn-primary btn-sm" title="Edit form">
                                                    <i class="fa fa-pencil"></i> 
                                                </a> 
                                                {{-- <button class="btn btn-primary btn-sm clipboard" data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}" data-message="" data-original="" title="Copy form URL to clipboard">
                                                    <i class="fa fa-clipboard"></i> 
                                                </button>  --}}
            
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
                        @else  
                        <h4 class="text-danger text-center">
                            No form to display.
                        </h4>
                        @endif
                    </div>
                    <div class="card-footer px-4">
                        <div>{{ $forms->links('vendor.pagination.bootstrap-5') }}</div>
                    {{-- @if($forms->hasPages())
                    @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
