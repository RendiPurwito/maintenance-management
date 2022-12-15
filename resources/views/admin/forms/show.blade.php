@extends('formbuilder::layout')

@section('content')
<div class="">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card ">
                <div class="card-header d-flex justify-content-between mb-3">
                    <h5 class="card-title">
                        Form Preview for <strong>'{{ $form->name }}'</strong>
                    </h5>
                    <div class="btn-toolbar float-md-end" role="toolbar">
                        <div class="btn-group" role="group">
                            <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-primary float-md-right btn-sm" title="Back To Forms">
                                <i class="fa fa-arrow-left"></i> 
                            </a>
                            <a href="{{ route('formbuilder::forms.submissions.index', $form) }}" class="btn btn-primary float-md-right btn-sm" title="View Submissions">
                                <i class="fa fa-th-list"></i> 
                            </a> 
                            <a href="{{route('formpdf', $form->identifier)}}" class="btn btn-primary btn-sm" title="Export To PDF" target="_blank">
                                <i class="fa-solid fa-file-pdf"></i>
                            </a>
                            <a href="{{ route('formbuilder::forms.edit', $form) }}" class="btn btn-primary float-md-right btn-sm" title="Edit Form">
                                <i class="fa fa-edit"></i> 
                            </a> 
                            {{-- <a href="{{ route('formbuilder::forms.create') }}" class="btn btn-primary float-md-right btn-sm" title="Add New Form">
                                <i class="fa fa-plus-circle"></i> 
                            </a> --}}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div id="fb-render"></div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title ">
                        Details 
                        {{-- <button class="btn btn-primary btn-sm clipboard float-right" data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}" data-message="Copied" data-original="Copy Form URL" title="Copy form URL to clipboard">
                            <i class="fa fa-clipboard"></i> Copy Form URL
                        </button>  --}}
                    </h5>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Public URL: </strong> 
                        <a href="{{ route('formbuilder::form.render', $form->identifier) }}" class="float-right" target="_blank">
                            {{$form->identifier}}
                        </a>
                    </li>
                    <li class="list-group-item">
                        <strong>Visibility: </strong> <span class="float-right">{{ $form->visibility }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Allows Edit: </strong> 
                        <span class="float-right">{{ $form->allowsEdit() ? 'YES' : 'NO' }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Owner: </strong> <span class="float-right">{{ $form->user->name }}</span>
                    </li>
                     <li class="list-group-item">
                        <strong>Current Submissions: </strong> 
                        <span class="float-right">{{ $form->submissions_count }}</span>
                    </li>
                    <li class="list-group-item">
                        <strong>Last Updated On: </strong> 
                        <span class="float-right">
                            {{ $form->updated_at->toDayDateTimeString() }}
                        </span>
                    </li>
                    <li class="list-group-item">
                        <strong>Created On: </strong> 
                        <span class="float-right">
                            {{ $form->created_at->toDayDateTimeString() }}
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top">
    <i class='bx bx-up-arrow-alt'></i>
</button>
@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('vendor/formbuilder/js/preview-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
@endpush

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