@extends('formbuilder::layout')

@section('css')
<style>
    @media screen and (max-width: 640px) {
        .card .card-body{
            padding: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header d-flex justify-content-between mb-3">
                    <h5 class="card-title">
                        Edit My Submission for <strong>{{ $submission->form->name }}</strong>
                        {{-- {{ $pageTitle }} --}}
                    </h5>
                    <div class="btn-toolbar" role="toolbar">
                        <div class="btn-group" role="group" aria-label="Third group">
                            {{-- <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary float-md-right btn-sm" title="Back To My Submissions">
                                <i class="fa fa-arrow-left"></i>
                            </a> --}}
                        </div>
                    </div>
                </div>
            
                <form action="{{ route('formbuilder::my-submissions.update', $submission->id) }}" method="POST" id="submitForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <div id="fb-render"></div>
                    </div>
            
                    <div class="card-footer d-flex justify-content-end">
                        <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-danger me-1" >
                            {{-- <i class="fa fa-arrow-left"></i> --}}
                            Cancel
                        </a>
                        {{-- <a href="{{ url()->previous() }}" class="btn btn-danger me-1" title="Back To Dashboard">
                            Cancel
                        </a> --}}
                        <button type="submit" class="btn btn-primary confirm-form" data-form="submitForm" data-message="Submit update to your entry for '{{ $submission->form->name }}'?">
                            Submit Form
                        </button>
                        <div class="float-end">
                        </div>
                    </div>
                </form>
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
        window._form_builder_content = {!! json_encode($submission->form->form_builder_json) !!}
    </script>
    <script src="{{ asset('vendor/formbuilder/js/render-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
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