@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header mb-3 d-flex pt-3">
                    <h5 class="fw-bold">Notification</h5>
                    {{-- <h5 class="font-weight-bold mr-3">
                        <a href="#" class="text-dark" id="showr">User</a>
                    </h5>
                    <h5 class="font-weight-bold mr-3">
                        <a href="#" class="text-dark" id="showc">Form</a>
                    </h5>
                    <h5 class="font-weight-bold">
                        <a href="#" class="text-dark" id="shows">Submission</a>
                    </h5> --}}
                </div>
                <div class="card-body">
                    {{-- Showing User Registration Notification --}}
                    @forelse($notifications as $notification)
                    <div class="alert alert-light-info text-dark" role="alert">
                        {{-- [{{ $registration->created_at }}] User {{ $registration->data['name'] }}
                        ({{ $registration->data['email'] }}) {{ $registration->data['message'] }}. --}}
                        [{{ $notification->created_at }}] User <b>{{ $notification->data['name'] }}</b> {{ $notification->data['message'] }} <b>{{ $notification->data['subject'] }}</b> 
                        <a href="#" class="float-end mark-as-read fw-bolder" data-id="{{ $notification->id }}">
                            Mark as read
                        </a>
                    </div>
                    @if($loop->last)
                    <a href="#" id="mark-all" class="float-end fw-bold">
                        Mark all as read
                    </a>
                    @endif
                    @empty
                    There is no new notifications
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script>
    function sendMarkRequest(id = null) {
        return $.ajax("{{ route('markNotif') }}", {
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id
            }
        });
    }
    $(function () {
        $('.mark-as-read').click(function () {
            let request = sendMarkRequest($(this).data('id'));
            request.done(() => {
                $(this).parents('div.alert').remove();
            });
        });
        $('#mark-all').click(function () {
            let request = sendMarkRequest();
            request.done(() => {
                $('div.alert').remove();
            })
        });
    });
</script>
@endsection