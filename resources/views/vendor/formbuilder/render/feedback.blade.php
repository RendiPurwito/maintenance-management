@extends('formbuilder::layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between mb-3">
                    <h5 class="card-title fw-bold">
                        Form Successfully submitted
                    </h5>
                    @auth
                        <a href="{{ route('formbuilder::my-submissions.index') }}" class="btn btn-primary btn-sm float-md-right">
                            <i class="fa fa-th-list"></i> Go To My Submissions
                        </a>
                    @endauth
                </div>

                <div class="card-body">
                    <h3 class="text-center text-success">
                        Your entry for <strong>{{ $form->name }}</strong> was successfully submitted.
                    </h3>
                </div>

                <div class="card-footer">
                    <a href="/dashboard" class="btn btn-primary float-end">
                        <i class="fa fa-home"></i> Return Home
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
