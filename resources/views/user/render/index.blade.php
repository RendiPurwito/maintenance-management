@extends('formbuilder::layout')

@section('content')
{{-- <div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-primary mb-2" title="Back To Dashboard">
        <i class="fa-solid fa-chevron-left"></i>
        Back To Submissions
    </a>
</div> --}}
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between mb-3">
                <h5 class="card-title fw-bold">{{ $pageTitle }}</h5>
            </div>

            <form action="{{ route('formbuilder::form.submit', $form->identifier) }}" method="POST" id="submitForm" enctype="multipart/form-data">
                @csrf
                
                <div class="card-body">
                    <div id="fb-render"></div>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-danger me-1" title="Back To Dashboard">
                        Cancel
                    </a>
                    <button id="Submit" type="submit" class="btn btn-primary confirm-form " data-form="submitForm">Submit Form </button>
                    <noscript>
                        <p>This site is best viewed with Javascript. Please allow javascript to run.</p>
                    </noscript>
                
                    <script>
                        $(function(){
                            $('#Submit').attr('disabled', false);
                
                            var $input = $('<button id="Submit" type="submit" class="btn btn-primary confirm-form float-end" data-form="submitForm"> <i class="fa fa-submit"></i> Submit Form </button>');
                            $input.appendTo($("#formSubmit"));
                
                            $('#Submit').attr('data-message', "Submit your entry for '{{ $form->name }}'?");
                        });
                    </script>
                </div>
            </form>
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

@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('/vendor/formbuilder/js/render-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
@endpush
