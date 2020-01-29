
@extends('layout')

@section('title', __('titles.search').' - '.__('general.graduate'))

@section('content')

{{-- Search bar --}}

<div class="row justify-content-center mt-3 filters sticky-top">
    <div class="col text-center">
    <button class="d-inline-block d-lg-none btn btn-primary mb-1" type="button" data-toggle="collapse" data-target="#collapseSearchBar" aria-expanded="false" aria-controls="collapseSearchBar">
            @lang('general.filters')
    </button>
            <div class="collapse" id="collapseSearchBar">
            <div class="card card-body">
            <form method="GET" action="{{ url('graduates') }}" autocomplete="on">
                    <div class="form-row text-left">
                        <div class="form-group col">
                              <label for="inputSurname">{{ __('Surname') }}:</label>
                              <input type="text" class="form-control" id="inputSurname" placeholder="{{ __('Surname') }}" name="surname" value="{{ old('surname') }}">
                        </div>
                        <div class="form-group col">
                            <label for="inputName">{{ __('Name') }}:</label>
                            <input type="text" class="form-control" id="inputName" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group col">
                                <label for="inputMaturaYear">{{ __('Matura year') }}:</label>
                                <input type="number" min="1874" max="2099" step="1" class="form-control" id="inputMaturaYear" placeholder="{{ __('Matura year') }}" name="matura_year" value={{ old('matura_year') }}>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search mr-2"></i>{{ __('Search') }}</button>
            </form>
            </div>
            </div>
    </div>

</div>

{{-- Graduates table --}}

@include('session-status')

<section class="d-flex justify-content-center">

@can('forceDeleted', App\Graduate::class)
  <section class="d-inline m-1">
    <a class="btn btn-primary" href="{{ url('graduates/deleted') }}"><i class="fas fa-trash-alt"></i> {{ __('Bin') }}</a>
  </section>
@endcan

@can('change', App\Graduate::class)
  <section class="d-inline m-1">
    <a class="btn btn-primary" href="{{ url('graduates/create') }}"><i class="fas fa-plus"></i> {{ __('Create') }}</a>
  </section>
@endcan

</section>

<section>

    @foreach ($graduates as $graduate)

    <section class="card my-2 shadow-sm rounded graduate-card">
        <div class="row no-gutters">
          <div class="col-4 col-lg-2 d-flex align-items-center graduate-card__avatar">
            <img src="{{ asset('uploads/'.$graduate->id.'/avatars/'.$graduate->avatar) }}" class="card-img p-1" alt="avatar">
          </div>
          <div class="col-8 col-lg-10 graduate-card__text">
            <div class="card-body">
            <a href="{{ url('graduates/'.$graduate->id) }}" class="card-title text-uppercase stretched-link">{{ $graduate->surname.' '.$graduate->name }}</a>
            <p class="card-text">{{ __('Matura year') }}: {{ $graduate->matura_year }}</p>
            <p class="card-text"><small class="text-muted">{{ __('Created at') }}: {{ $graduate->created_at }}</small></p>
            <p class="card-text"><small class="text-muted">{{ __('Last updated at') }}: {{ $graduate->updated_at }}</small></p>
            @can('forceDeleted', App\Graduate::class)
            <p class="card-text"><small class="text-muted">{{ __('Last edited by') }}: {{ $graduate->editor->name.", ".$graduate->editor->email }}</small></p>
            @endcan
            </div>
          </div>
        </div>
    </section>

    @endforeach

    @if (count($graduates) == 0)

    <div class="alert alert-danger show mt-2" role="alert">
        <strong>{{ __('No search results') }}</strong> {{ __('Try to search something else') }}
    </div>

    @endif

    {{ $graduates->onEachSide(1)->links() }}

</section>

@endsection