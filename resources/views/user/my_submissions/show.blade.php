@extends('formbuilder::layout')

@section('content')
{{-- <div class="container">
</div> --}}
<a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary mb-2" >
    {{-- <i class="fa fa-arrow-left"></i>  --}}
    <i class="fa-solid fa-chevron-left"></i>
    Back To My Submissions
</a>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card rounded-0">
            <div class="card-header d-flex justify-content-between mb-3">
                <h5 class="card-title">
                    Viewing my submission for form 
                    <strong>{{ $submission->form->name }}</strong>
                </h5>
                <div class="btn-toolbar float-end" role="toolbar">
                    <div class="btn-group" role="group" aria-label="First group">
                        {{-- <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary btn-sm" title="Back To My Submissions">
                            <i class="fa fa-arrow-left"></i> 
                        </a> --}}
                        @if($submission->form->allowsEdit())
                            <a href="{{ route('formbuilder::my-submissions.edit', $submission) }}" class="btn btn-primary btn-sm" title="Edit this submission">
                                <i class="fa fa-pencil"></i> 
                            </a>
                        @endif
                        {{-- <form action="{{ route('formbuilder::my-submissions.destroy', [$submission->id]) }}" method="POST" id="deleteSubmissionForm_{{ $submission->id }}" class="d-inline-block">
                            @csrf 
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm rounded-0 confirm-form" data-form="deleteSubmissionForm_{{ $submission->id }}" data-message="Delete submission" title="Delete this submission?">
                                <i class="fa fa-trash-o"></i> 
                            </button>
                        </form> --}}
                    </div>
                </div>
            </div>

            <ul class="list-group list-group-flush">
                @foreach($form_headers as $header)
                    <li class="list-group-item">
                        <strong>{{ $header['label'] ?? ucwords($header['name']) }}: </strong> 
                        <span class="float-right">
                            {{ $submission->renderEntryContent($header['name'], $header['type']) }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card rounded-0">
            <div class="card-header">
                <h5 class="card-title">Details</h5>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>Form: </strong> 
                    <span class="float-right">{{ $submission->form->name }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Submitted By: </strong> 
                    <span class="float-right">{{ $submission->user->name ?? 'Guest' }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Last Updated On: </strong> 
                    <span class="float-right">{{ $submission->updated_at->toDayDateTimeString() }}</span>
                </li>
                <li class="list-group-item">
                    <strong>Submitted On: </strong> 
                    <span class="float-right">{{ $submission->created_at->toDayDateTimeString() }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top">
    <i class='bx bx-up-arrow-alt'></i>
</button>
@endsection

@section('javascript')
<script>
    // Get the button:
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }   

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>
@endsection
