<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div id="fb-render"></div>
    <script type="text/javascript">
        jQuery(function () {
            var fbRenderOptions = {
                container: false,
                dataType: 'json',
                formData: window._form_builder_content ? window._form_builder_content : '',
                render: true,
            }

            $('#fb-render').formRender(fbRenderOptions)
        })
    </script>
</body>

</html>