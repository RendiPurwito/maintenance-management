@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="row">
    <div class="card">
        <div class="card-header mb-3 d-flex pt-3">
            <h5 class="font-weight-bold mr-3">
                <a href="#" class="text-dark" id="showr">User Registration</a>
            </h5>
            <h5 class="font-weight-bold mr-3">
                <a href="#" class="text-dark" id="showc">Form Creation</a>
            </h5>
            <h5 class="font-weight-bold">
                <a href="#" class="text-dark" id="shows">Form Submission</a>
            </h5>
        </div>
        <div class="card-body">
            {{-- Showing User Registration Notification --}}
            <div id="registration-notif" style="display: none">
                @forelse($notifications as $registration)
                <div class="alert alert-light-info font-weight-bold text-dark" role="alert">
                    [{{ $registration->created_at }}] User {{ $registration->data['name'] }}
                    ({{ $registration->data['email'] }}) {{ $registration->data['message'] }}.
                    <a href="#" class="float-right mark-as-read font-weight-bolder" data-id="{{ $registration->id }}">
                        Mark as read
                    </a>
                </div>

                @if($loop->last)
                <a href="#" id="mark-all">
                    Mark all as read
                </a>
                @endif
                @empty
                There are no new notifications
                @endforelse
            </div>

            {{-- Showing Form Creation Notification --}}
            <div id="creation-notif" style="display: none">
                @forelse($notifications as $creation)
                <div class="alert alert-light-info font-weight-bold text-dark" role="alert">
                    [{{ $creation->created_at }}] User {{ $creation->data['user'] }}
                    has just submitted {{ $creation->data['form']}}({{ $creation->data['form_id']}}).
                    <a href="#" class="float-right mark-as-read font-weight-bolder" data-id="{{ $creation->id }}">
                        Mark as read
                    </a>
                </div>

                @if($loop->last)
                <a href="#" id="mark-all">
                    Mark all as read
                </a>
                @endif
                @empty
                There are no new notifications
                @endforelse
            </div>

            {{-- Showing Form Submission Notification --}}
            <div id="submission-notif" style="display: none">
                @forelse($notifications as $notification)
                <div class="alert alert-light-info font-weight-bold text-dark" role="alert">
                    [{{ $notification->created_at }}] User {{ $notification->data['user'] }}
                    has submitted
                    {{ $notification->data['form_id'] }}.
                    <a href="#" class="float-right mark-as-read font-weight-bolder" data-id="{{ $notification->id }}">
                        Mark as read
                    </a>
                </div>

                @if($loop->last)
                <a href="#" id="mark-all">
                    Mark all as read
                </a>
                @endif
                @empty
                There are no new notifications
                @endforelse
            </div>
        </div>
    </div>
</div>

@endsection
@section('javascript')
<script>
    $("#showr").click(function(e){
        e.preventDefault();
        $("#registration-notif").show();
    });
    $("#showc").click(function(e){
        e.preventDefault();
        $("#creation-notif").show();
    });
    $("#shows").click(function(e){
        e.preventDefault();
        $("#submission-notif").show();
    });
</script>
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