
@extends('layout')

@section('content')

@include('session-status')

@if (session('verified'))
    <div class="alert alert-success alert-dismissible fade show my-1" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ __("Your email address has been verified.") }}
            <button type="button" class="close" data-dismiss="alert" aria-label="@lang('general.close')">
              <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

@if(auth()->check())

<div class="alert alert-primary text-center my-1"role="alert">
        <h4 class="header-font">{{ __("Hello") }} {{ auth()->user()->name }} !</h4>
</div>

@endif

<div class="jumbotron mt-3">
        <h1 class="display-4">System absolwentów! - W BUDOWIE </h1>
        <p class="lead">Przeszukuj spis absolwentów szkoły Staszica! Teraz to bardzo proste!</p>
        <hr class="my-4">
        <p>Aby w pełni moc korzystać z usługi, zaloguj się.</p>
        <a class="btn btn-primary btn-lg" href="{{route('graduates.index')}}" role="button">Przeszukaj teraz!</a>
</div>

@endsection