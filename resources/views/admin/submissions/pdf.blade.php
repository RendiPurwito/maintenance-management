<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{--! Form Builder CSS --}}
    @stack('styles')

    {{--! Bootstrap --}}
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.css">

    {{--! Voler CSS --}}
    <link rel="stylesheet" href="/template/dist/assets/css/app.css">

    {{--! Font Awesome --}}
    <script src="https://kit.fontawesome.com/e5a524ad24.js"></script>

    <style>
        body{
            margin: 50px;
        }

        .table, tr, td{
            border: 2px solid;
        }
        
        @media print{
            .btn{
                display: none;
            }
        }
    </style>
</head>
<body>
    <button onclick="window.print()" class="btn btn-primary mb-3">Print</button>
    <ul class="list-group list-group-flush">
        <table class="table">
            @foreach($form_headers as $header)
            <tr>
                <td class="p-2 w-25">
                    <strong class="">{{ $header['label'] ?? title_case($header['name']) }}: </strong>
                </td>
                <td class="p-2">
                    <p class="">
                        {{ $submission->renderEntryContent($header['name'], $header['type']) }}
                    </p>
                </td>
            </tr>
            @endforeach
        </table>
        {{-- <div class="">
            <strong class="">{{ $header['label'] ?? title_case($header['name']) }}: </strong> 
            
            <p class="">
                {{ $submission->renderEntryContent($header['name'], $header['type']) }}
            </p>
        </div> --}}
    </ul>
</body>
</html>