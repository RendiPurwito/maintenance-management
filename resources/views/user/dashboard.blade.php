@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="">
        @foreach ($forms as $form)
        <div class="col border border-2 border-dark m-2">
            <a href="{{ route('formbuilder::form.render', $form->identifier) }}" class="text-decoration-none fs-4 m-2">
                {{$form->name}}
            </a>
        </div>
        @endforeach
    </div>
@endsection