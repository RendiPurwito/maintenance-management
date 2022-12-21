@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')
    <style>
        .overflow-auto{
            height: 50vh;
        }
        /* .mark-as-read{
            float: right !important;
        } */

        @media screen and (min-width: 360px) {
            #main .main-content {
                padding: 1rem 1rem;
            }

        }
    </style>
@endsection
@section('content')
{{-- <div class="container">
    <div class="row">
        <div class="col-md-12">
        </div>
    </div>
</div> --}}
<div class="card">
    <div class="card-header mb-3 d-flex pt-3">
        <h5 class="fw-bold">Notifications ({{$numberOfNotifications}})</h5>
    </div>
    <div class="card-body">
        <div class="overflow-auto" >
            @foreach($notifications as $notification)
                <div class="alert alert-light-info text-dark fs-6" role="alert">
                {{-- [{{ $registration->created_at }}] User {{ $registration->data['name'] }}
                ({{ $registration->data['email'] }}) {{ $registration->data['message'] }}. --}}
                <p class="notif">
                    [{{ $notification->created_at }}] User <b>{{ $notification->data['name'] }}</b>
                    {{ $notification->data['message'] }} <b>{{ $notification->data['subject'] }}</b>
                </p>
                <a href="#" class="mark-as-read fw-bolder" data-id="{{ $notification->id }}" id="markAsRead">
                    Mark as read
                </a>
                </div>
            @endforeach
        </div>
        @if ($numberOfNotifications==0)
            <p class="fs-5 align-middle text-center mt-3 fw-normal text-danger">There is no new notifications</p>
        @endif
    </div>
    @if ($numberOfNotifications>0)
    <div class="card-footer mt-3">
        <a href="#" id="mark-all" class="float-end fw-bold me-4">
            Mark all as read
        </a>
    </div>
    @endif
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
        $('.mark-as-read').click(function (e) {
            e.preventDefault();
            swal({
                icon: "warning",
                title: "Are you sure?",
                text: "Mark this notification as read?",
                buttons: true,
                dangerMode: true
            }).then((isConfirm) => {
                if (isConfirm) {
                    let request = sendMarkRequest($(this).data('id'));
                    request.done(() => {
                        $(this).parents('div.alert').remove();
                    });
                    // swal({
                    //     icon: "success",
                    //     title: 'User successfully created!',
                    // });
                }
            });
        });

        $('#mark-all').click(function (e) {
            e.preventDefault();
            swal({
                icon: "warning",
                title: "Are you sure?",
                text: "Mark all notification as read?",
                buttons: true,
                dangerMode: true
            }).then((isConfirm) => {
                if (isConfirm) {
                    let request = sendMarkRequest();
                    request.done(() => {
                        $('div.alert').remove();
                    })
                }
            });
        });
    });

</script>
@endsection