@extends('formbuilder::layout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-3">
                    <h5 class="fw-bold">
                        {{ $pageTitle }} ({{ $submissions->count() }})
                    </h5>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group" role="group" aria-label="Third group">
                            <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-arrow-left"></i> Back To Forms
                            </a>
                        </div>
                    </div>
                </div>

                @if($submissions->count())
                    <div class="card-content">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table  d-table table-hover" id="table">
                                    <thead>
                                        <tr>
                                            <th class="five">#</th>
                                            <th class="fifteen">User Name</th>
                                            @foreach($form_headers as $header)
                                                <th>{{ $header['label'] ?? title_case($header['name']) }}</th>
                                            @endforeach
                                            <th class="fifteen" data-sortable="false">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($submissions as $submission)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $submission->user->name ?? 'n/a' }}</td>
                                                @foreach($form_headers as $header)
                                                    <td>
                                                        {{ 
                                                            $submission->renderEntryContent(
                                                                $header['name'], $header['type'], true
                                                            ) 
                                                        }}
                                                    </td>
                                                @endforeach
                                                <td>
                                                    <a href="{{ route('formbuilder::forms.submissions.show', [$form, $submission->id]) }}" class="btn btn-primary btn-sm" title="View submission">
                                                        <i class="fa fa-eye"></i> View
                                                    </a> 
        
                                                    <form action="{{ route('formbuilder::forms.submissions.destroy', [$form, $submission]) }}" method="POST" id="deleteSubmissionForm_{{ $submission->id }}" class="d-inline-block">
                                                        @csrf 
                                                        @method('DELETE')
        
                                                        <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteSubmissionForm_{{ $submission->id }}" data-message="Delete this submission?" title="Delete submission">
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
                            No submission to display.
                        </h4>  
                        </div>
                        <div class="card-footer px-4">
                            <div>{{ $submissions->links('vendor.pagination.bootstrap-5') }}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
