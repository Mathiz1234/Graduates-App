
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

<section class="d-none d-md-block mt-2">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="{{ asset('img/1-slider.png') }}" class="d-block w-100" alt="...">
              <div class="carousel-caption-new d-none d-md-block">
                <h5>{{ __('List of graduates')}}</h5>
                <p>{{ __ ('Search the graduates of your school!')}}</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('img/2-slider.png') }}" class="d-block w-100" alt="...">
              <div class="carousel-caption-new d-none d-md-block">
                <h5>{{ __('Easy access')}}</h5>
                <p>{{ __('Thanks to the cloud you can use the system all over the world.')}}</p>
              </div>
            </div>
            <div class="carousel-item">
              <img src="{{ asset('img/3-slider.png') }}" class="d-block w-100" alt="...">
              <div class="carousel-caption-new d-none d-md-block">
                <h5>{{ __('Save, edit, delete ...')}}</h5>
                <p>{{ __('Log into the system to get more options')}}</p>
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('pagination.previous')</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">@lang('pagination.next')</span>
          </a>
        </div>
</section>

<section class="card text-center my-2">
        <div class="card-header">
                {{ __('general.graduate') }}
        </div>
        <div class="card-body">
          <h5 class="card-title">{{ __('Search the graduates database now!')}}</h5>
          <p class="card-text">{{ __('To fully use the service, log in.')}}</p>
          <a href="{{route('graduates.index')}}" class="btn btn-primary">{{ __('Click now!')}}</a>
        </div>
</section>

@endsection