@extends('formbuilder::layout')

@section('css')
    <style>
        .btn-footer{
            float: right;
        }

        @media screen and (max-width: 640px) {
            .card .card-body{
                padding: 0.5rem;
            }

            .alert{
                padding: 1rem;
            }

            .card-footer{
                padding: 0.5rem;
                display: flex;
                justify-content: end
            }

            /* .btn-footer{
                display: flex;
                justify-content: space-between;
            } */

            .btn{
                padding: 0.375rem 1rem;
                margin-left: 0.20rem;
            }

            .form-wrap.form-builder .frmb-control li:before {
                font-size: 25px;
            }
        }
    </style>
@endsection
@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        </div>
    </div>
</div> --}}
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h5 class="card-title fw-bold">
            {{ $pageTitle ?? '' }}
        </h5>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group" role="group">
                {{-- <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-sm btn-primary float-md-right" title="Back To Forms">
                    <i class="fa fa-arrow-left"></i> 
                </a> --}}
                {{-- <button class="btn btn-primary btn-sm clipboard" data-clipboard-text="{{ route('formbuilder::form.render', $form->identifier) }}" data-message="Link Copied" data-original="Copy Form Link" title="Copy form URL to clipboard">
                    <i class="fa fa-clipboard"></i> Copy Form Link
                </button>  --}}
            </div>
        </div>
    </div>

    <form action="{{ route('formbuilder::forms.update', $form) }}" method="POST" id="createFormForm" data-form-method="PUT">
        @csrf 
        @method('PUT')
        
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Form Name</label>

                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') ?? $form->name }}" required autofocus placeholder="Enter Form Name">

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="visibility" class="col-form-label">Form Visibility</label>

                        <select name="visibility" id="visibility" class="form-control" required="required">
                            <option value="">Select Form Visibility</option>
                            @foreach(jazmy\FormBuilder\Models\Form::$visibility_options as $option)
                                <option value="{{ $option['id'] }}" @if($form->visibility == $option['id']) selected @endif>
                                    {{ $option['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @if ($errors->has('visibility'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('visibility') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-4" @if($form->isPublic()) style="display: none;" id="allows_edit_DIV" @endif>
                    <div class="form-group">
                        <label for="allows_edit" class="col-form-label">
                            Allow Submission Edit
                        </label>

                        <select name="allows_edit" id="allows_edit" class="form-control" required="required">
                            <option value="0" @if($form->allows_edit == 0) selected @endif>
                                NO (submissions are final)
                            </option>
                            <option value="1" @if($form->allows_edit == 1) selected @endif>
                                YES (allow users to edit their submissions)
                            </option>
                        </select>

                        @if ($errors->has('allows_edit'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('allows_edit') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="alert alert-info" role="alert">
                        <i class="fa fa-info-circle"></i> 
                        Click on or Drag and drop components onto the main panel to build your form content.
                    </div>

                    <div id="fb-editor" class="fb-editor"></div>
                </div>
            </div>
        </div>
    </form>

    <div class="card-footer" id="fb-editor-footer" style="display: none;">
        <div class="btn-footer">
            <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-danger">
                {{-- <i class="fa fa-arrow-left"></i>  --}}
                Cancel
            </a>
            <button type="button" class="btn btn-primary fb-clear-btn">
                <i class="fa fa-remove"></i> Clear Form 
            </button> 
            <button type="button" class="btn btn-primary fb-save-btn">
                <i class="fa fa-save"></i> Save Form
            </button>
        </div>
    </div>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top">
    <i class='bx bx-up-arrow-alt'></i>
</button>
@endsection

@push(config('formbuilder.layout_js_stack', 'scripts'))
    <script type="text/javascript">
        window.FormBuilder = window.FormBuilder || {}
        window.FormBuilder.form_roles = @json($form_roles);
        
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('vendor/formbuilder/js/create-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
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
