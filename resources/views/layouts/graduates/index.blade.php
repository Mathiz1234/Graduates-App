
@extends('layout')

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
                            <label for="inputName">{{ __('Name') }}:</label>
                            <input type="text" class="form-control" id="inputName" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="form-group col">
                                <label for="inputSurname">{{ __('Surname') }}:</label>
                                <input type="text" class="form-control" id="inputSurname" placeholder="{{ __('Surname') }}" name="surname" value="{{ old('surname') }}">
                        </div>
                        <div class="form-group col">
                                <label for="inputMatureYear">{{ __('Mature year') }}:</label>
                                <input type="number" min="1874" max="2099" step="1" class="form-control" id="inputMatureYear" placeholder="{{ __('Mature year') }}" name="mature_year" value={{ old('mature_year') }}>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search mr-2"></i>{{ __('Search') }}</button>
            </form>
            </div>
            </div>
    </div>

</div>

{{-- Graduates table --}}

<section>

    @foreach ($graduates as $graduate)

    <section class="card my-2 shadow-sm rounded graduate-card">
        <div class="row no-gutters">
          <div class="col-4 col-lg-2 d-flex align-items-center graduate-card__avatar">
            <img src="{{ asset('img/avatars/'.$graduate->avatar) }}" class="card-img p-1" alt="avatar">
          </div>
          <div class="col-8 col-lg-10 graduate-card__text">
            <div class="card-body">
            <a href="{{ url('graduates/'.$graduate->id) }}" class="card-title text-uppercase stretched-link">{{ $graduate->surname.' '.$graduate->name }}</a>
            <p class="card-text">Rok matury: {{ $graduate->mature_year }}</p>
            <p class="card-text"><small class="text-muted">{{ __('Created at') }}: {{ $graduate->created_at }}</small></p>
            <p class="card-text"><small class="text-muted">{{ __('Last updated at') }}: {{ $graduate->updated_at }}</small></p>
            </div>
          </div>
        </div>
    </section>

    @endforeach

    @if (count($graduates) == 0)

    <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
        <strong>{{ __('No search results') }}</strong> {{ __('Try to search something else') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="@lang('general.close')">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endif

    {{ $graduates->onEachSide(1)->links() }}

</section>

@endsection