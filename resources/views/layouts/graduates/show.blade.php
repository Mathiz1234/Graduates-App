
@extends('layout')

@section('content')

{{-- Graduate table --}}

<section class="card my-2 shadow-sm rounded graduate-card">
    <div class="row no-gutters">
      <div class="col-4 col-lg-2 d-flex align-items-start graduate-card__avatar">
        <img src="{{ asset('storage/avatars/'.$graduate->avatar) }}" class="card-img p-1" alt="avatar">
      </div>
      <div class="col-8 col-lg-10 graduate-card__text">
        <div class="card-body">
        <p class="card-text">{{ __('Name') }}: <strong>{{ $graduate->name }}</strong></p>
        <p class="card-text">{{ __('Surname') }}: <strong>{{ $graduate->surname }}</strong></p>
        <p class="card-text">{{ __('Matura year') }}: <strong>{{ $graduate->matura_year }}</strong></p>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="graduate-card__text p-1 text-justify">
            <div class="card-body">
            <p class="card-text">{{ __('Description') }}: {{ $graduate->description }}</p>
            <p class="card-text"><small class="text-muted">{{ __('Created at') }}: {{ $graduate->created_at }}</small></p>
            <p class="card-text"><small class="text-muted">{{ __('Last updated at') }}: {{ $graduate->updated_at }}</small></p>
            </div>
          </div>
    </div>
</section>

@if($graduate->files->count())

<div class="list-group mb-2">
    <a href="#" class="list-group-item list-group-item-action disabled" aria-disabled="true" tabindex="-2">
        {{ __('List of .pdf files') }}:
    </a>
    @foreach ($graduate->files as $file)
    <a href="{{ asset('storage/files/'.$file->image_url) }}" target="_blank" class="list-group-item list-group-item-action">{{ $file->filename }}</a>
    @endforeach
</div>

@endif


@if($graduate->scans->count())
<section>
    <div class="card graduate-card">
        <div class="card-body row">
          @foreach ($graduate->scans as $scan)
          <div class="col-12 col-lg-6 p-1 graduate-card__img d-flex align-items-center" style="max-height: 400px; overflow:hidden;">
            <img src="{{ asset('storage/scans/'.$scan->image_url) }}" class="graduate-card__img--file img-fluid rounded border border-success" alt="@lang('general.scan')">
            <a class="graduate-card__img--link" href="{{ asset('storage/scans/'.$scan->image_url) }}" target="_blank">@lang('general.click') <i class="fas fa-hand-pointer"></i></a>
          </div>
          @endforeach
        </div>
      </div>
</section>
@endif

<section class="d-flex my-2 justify-content-center">
    <a href="{{ url('graduates') }}" class="btn btn-primary mx-2">@lang('general.back')</a>
    @can('change', App\Graduate::class)
    <a href="{{ url('graduates/'.$graduate->id.'/edit') }}" class="btn btn-primary mx-2">@lang('general.edit')</a>
    <form class="d-inline-block mx-2" method="POST" action="{{ url('graduates/'.$graduate->id) }}">
        @method('DELETE')

        @csrf
    <button type="submit" class="btn btn-primary">@lang('general.delete')</button>
  </form>
    @endcan
</section>

@endsection