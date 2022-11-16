<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/formbuilder/css/styles.css') }}{{ jazmy\FormBuilder\Helper::bustCache() }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
</head>

<body>
    <div id="fb-render"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.js" referrerpolicy="no-referrer"></script>
    <script type="text/javascript">
		window.FormBuilder = {
			csrfToken: '{{ csrf_token() }}',
		}
	</script>
	<script src="{{ asset('/vendor/formbuilder/js/jquery-ui.min.js') }}" defer></script>
	<script src="{{ asset('/vendor/formbuilder/js/sweetalert.min.js') }}" defer></script>
	<script src="{{ asset('/vendor/formbuilder/js/jquery-formbuilder/form-builder.min.js') }}" defer></script>
	<script src="{{ asset('/vendor/formbuilder/js/jquery-formbuilder/form-render.min.js') }}" defer></script>
	<script src="{{ asset('/vendor/formbuilder/js/parsleyjs/parsley.min.js') }}" defer></script>
	<script src="{{ asset('/vendor/formbuilder/js/clipboard/clipboard.min.js') }}?b=ck24" defer></script>
	<script src="{{ asset('/vendor/formbuilder/js/script.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
    <script type="text/javascript">
        window._form_builder_content = {!! json_encode($form->form_builder_json) !!}
    </script>
    <script src="{{ asset('vendor/formbuilder/js/preview-form.js') }}{{ jazmy\FormBuilder\Helper::bustCache() }}" defer></script>
</body>

</html>