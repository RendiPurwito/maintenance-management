@extends('formbuilder::layout')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header d-flex justify-content-between mb-3">
                    <h5 class="card-title fw-bold">
                        Form Successfully submitted
                    </h5>
                    @auth
                    <a href="{{ route('formbuilder::my-submissions.index') }}"
                        class="btn btn-primary btn-sm float-md-right" title="Go To My Submissions">
                        <i class="fa fa-th-list"></i>
                    </a>
                    @endauth
                </div> --}}

                <div class="card-body">
                    <h3 class="text-center text-success">
                        Your entry for <strong>{{ $form->name }}</strong> was successfully submitted.
                    </h3>
                </div>

                <div class="card-footer float-end">
                    <div class="btn-footer float-end">
                        @auth
                        <a href="{{ route('formbuilder::my-submissions.index') }}"
                            class="btn btn-primary" title="Go To My Submissions">
                            <i class="fa fa-th-list"></i>
                        </a>
                        @endauth
                        <a href="/dashboard" class="btn btn-primary" title="Return Home">
                            <i class="fa fa-home"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection