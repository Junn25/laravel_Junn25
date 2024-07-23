@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <a href="/hospitals" class="btn btn-primary btn-lg mx-3 py-4 px-5">Hospital</a>
                        <a href="/patients" class="btn btn-secondary btn-lg mx-3 py-4 px-5">Patient</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
