@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row d-flex flex-wrap">
        @foreach ($forms as $form)
        <div class="col border border-2 border-dark m-2 pt-2">
            <h5 class="">
                <a href="{{ route('formbuilder::form.render', $form->identifier) }}" class="text-decoration-none align-middle">
                    {{$form->name}}
                </a>
            </h5>
        </div>
        @endforeach
    </div>
@endsection