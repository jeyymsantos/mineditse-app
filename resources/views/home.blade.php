@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

<<<<<<< HEAD
                    {{ __('You are ldasdasogged in!') }}
=======
                    {{ __('You are logged in!') }}
>>>>>>> 118cfe519665c6df7e4deb7256a8e9abbaca4b66
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
