@extends('formbuilder::layout')

@section('content')
<div class="container">
    <a href="{{ url()->previous() }}" class="btn btn-primary mb-3">Back</a>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card rounded-0">
                <div class="card-header">
                    <h5 class="card-title">{{ $pageTitle }}</h5>
                </div>

                <form action="{{ route('formbuilder::form.submit', $form->identifier) }}" method="POST" id="submitForm" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="card-body">
                        <div id="fb-render"></div>
                    </div>

                    <div class="card-footer">
                        <button id="Submit" type="submit" class="btn btn-primary confirm-form" data-form="submitForm"></i> Submit Form </button>
                        <noscript>
                            <p>This site is best viewed with Javascript. Please allow javascript to run.</p>
                        </noscript>
                    
                        {{-- <script>
                            $(function(){
                                $('#Submit').attr('disabled', false);
                    
                                var $input = $('<button id="Submit" type="submit" class="btn btn-primary confirm-form" data-form="submitForm"> <i class="fa fa-submit"></i> Submit Form </button>');
                                $input.appendTo($("#formSubmit"));
                    
                                $('#Submit').attr('data-message', "Submit your entry for '{{ $form->name }}'?");
                            });
                        </script> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('/vendor/formbuilder/js/render-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
@endpush
