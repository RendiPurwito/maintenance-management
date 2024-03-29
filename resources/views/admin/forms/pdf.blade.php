<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{--! Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        #table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #000000;
            color: white;
        }
    </style>
</head>

<body>
    <table class="table table-bordered" id="table">
        <tr>
            <th class="five">#</th>
            <th class="twenty-five">Name</th>
            {{-- <th class="ten">Visibility</th> --}}
            <th>Allows Edit?</th>
            <th class="ten">Submissions</th>
            <th class="twenty-five">Created On</th>
        </tr>
        @foreach($forms as $form)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $form->name }}</td>
                                            {{-- <td>{{ $form->visibility }}</td> --}}
                                            <td>{{ $form->allowsEdit() ? 'YES' : 'NO' }}</td>
                                            <td>{{ $form->submissions_count }}</td>
                                            <td>{{ $form->created_at->toDayDateTimeString() }}</td>
                                        </tr>
                                    @endforeach
    </table>
</body>

</html>