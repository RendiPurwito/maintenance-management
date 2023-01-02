@extends('formbuilder::layout')

@section('content')
{{-- <div class="container-fluid">
    <div class="row justify-content-center">
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
    <div class="card-header d-flex justify-content-between mb-3">
        <h5 class="card-title">
            Submitted Entries for <strong>'{{ $pageTitle }}'</strong> ({{ $submissions->count() }})
        </h5>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group" role="group" aria-label="Third group">
                @if(request()->has('view_deleted'))
                    <a href="{{ route('formbuilder::forms.submissions.index', $form) }}" class="btn btn-primary btn-sm">View All Submission</a>
                    <a href="{{ route('submission.restore_all') }}" class="btn btn-primary btn-sm">Restore All</a>
                @else
                    <a href="{{ route('formbuilder::forms.submissions.index', [$form, 'view_deleted' => 'DeletedRecords']) }}" class="btn btn-primary btn-sm">View Deleted Submission</a>
                @endif
                <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-primary btn-sm" title="Back To Forms">
                    <i class="fa fa-arrow-left"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card-content">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  d-table table-striped" id="table">
                    <thead>
                        <tr>
                            <th class="five">#</th>
                            <th class="fifteen">User Name</th>
                            {{-- @foreach($form_headers as $header)
                            <th>{{ $header['label'] ?? title_case($header['name']) }}</th>
                            @endforeach --}}
                            <th class="ten">Submitted On</th>
                            <th class="ten">Last Updated On</th>
                            <th class="five" data-sortable="false">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($submissions as $submission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $submission->user->name ?? 'n/a' }}</td>
                            {{-- @foreach($form_headers as $header)
                            <td>
                                {{ 
                                                $submission->renderEntryContent(
                                                    $header['name'], $header['type'], true
                                                ) 
                                            }}
                            </td>
                            @endforeach --}}
                            <td>{{ $submission->created_at }}</td>
                            <td>{{ $submission->updated_at }}</td>
                            <td class="">
                                {{-- <a href="" class="btn btn-primary btn-sm">
                                    <i class="fa-solid fa-ellipsis-vertical"></i>
                                </a> --}}
                                @if(request()->has('view_deleted'))
                                    <a href="{{ route('submission.restore', $submission->id) }}" class="btn btn-success btn-sm">Restore</a>
                                @else
                                    <a href="{{ route('formbuilder::forms.submissions.show', [$form, $submission->id]) }}"
                                        class="btn btn-primary btn-sm" title="View submission">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    <form
                                        action="{{ route('formbuilder::forms.submissions.destroy', [$form, $submission]) }}"
                                        method="POST" id="deleteSubmissionForm_{{ $submission->id }}"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm confirm-form"
                                            data-form="deleteSubmissionForm_{{ $submission->id }}"
                                            data-message="Delete this submission?" title="Delete submission">
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
            {{-- @if($submissions->count())
            @else
            <h4 class="text-danger text-center">
                No submission to display.
            </h4>
            @endif --}}
        </div>
        {{-- <div class="card-footer px-4">
            <div>{{ $submissions->links('vendor.pagination.bootstrap-5') }}</div>
        </div> --}}
    </div>
</div>
@endsection