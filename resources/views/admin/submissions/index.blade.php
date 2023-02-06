@extends('formbuilder::layout')

@section('css')
    <style>
        @media screen and (max-width: 640px){
            #main .main-content {
                padding: 1rem 1rem;
            }

            .container-fluid{
                padding: 0;
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
        <div class="col-md-12">
            <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-primary mb-2" >
                <i class="fa-solid fa-chevron-left"></i>
                Back To Forms
            </a>
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-3">
                    <h5 class="card-title">
                        Submitted Entries for <strong>'{{ $pageTitle }}'</strong> ({{ $submissions->count() }})
                    </h5>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group" role="group" aria-label="Third group">
            
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