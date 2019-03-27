
@extends('layout')

@section('content')

<section class="row justify-content-center">

    <div class="card my-2 col col-lg-6">
        <div class="card-header">
        {{ __('Your personal data') }}:
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">{{ __('Name') }}: {{ auth()->user()->name }}</li>
        <li class="list-group-item">{{ __('E-Mail Address') }}: {{ auth()->user()->email }}
            @if (auth()->user()->ifEmailVerify())
                <span class="badge badge-success ml-1 text-uppercase">{{ __('verified') }}</span></li>
            @else
                <span class="badge badge-danger ml-1 text-uppercase">{{ __('unverified') }}</span></li>
            @endif
        <li class="list-group-item text-muted">{{ __('Account created at') }}: {{ auth()->user()->created_at }}</li>
        <li class="list-group-item"><a href="{{ url('account/change') }}" class="btn btn-primary text-uppercase">{{ __('Change personal data') }}</a></li>
        <li class="list-group-item"><a href="{{ url('account/change/password') }}" class="btn btn-primary text-uppercase">{{ __('Change password') }}</a></li>
    </ul>
    </div>

</section>

@endsection