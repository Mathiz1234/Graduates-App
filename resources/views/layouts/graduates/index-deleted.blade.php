
@extends('layout')

@section('title', __('titles.delete').' - '.__('general.graduate'))

@section('content')

<section>

  <header class="text-center">
    <h1 class="header-font text-uppercase">{{ __('Deleted graduates') }}</h1>
  </header>

  @foreach ($graduates as $graduate)

  <section class="card my-2 shadow-sm rounded graduate-card">
      <div class="row no-gutters">
        <div class="col-4 col-lg-2 d-flex align-items-center graduate-card__avatar">
          <img src="{{ asset('storage/avatars/'.$graduate->avatar) }}" class="card-img p-1" alt="avatar">
        </div>
        <div class="col-8 col-lg-10 graduate-card__text">
          <div class="card-body">
          <p class="card-title text-uppercase">{{ $graduate->surname.' '.$graduate->name }}</p>
          <p class="card-text">{{ __('Matura year') }}: {{ $graduate->matura_year }}</p>
          <p class="card-text"><small class="text-muted">{{ __('Created at') }}: {{ $graduate->created_at }}</small></p>
          <p class="card-text"><small class="text-muted">{{ __('Last updated at') }}: {{ $graduate->updated_at }}</small></p>
          <p class="card-text"><small class="text-muted">{{ __('Deleted at') }}: {{ $graduate->deleted_at }}</small></p>
          <form class="d-inline-block mb-1" method="POST" action="{{ url('graduates/deleted') }}">
            <input type="hidden" name="id" value="{{ $graduate->id }}">
            @csrf
            <button type="submit" class="btn btn-primary"><i class="fas fa-redo-alt"></i> {{ __('Restore') }}</button>
          </form>
          <form class="d-inline-block mb-1" method="POST" action="{{ url('graduates/deleted') }}">
            <input type="hidden" name="id" value="{{ $graduate->id }}">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-primary"><i class="fas fa-trash"></i> {{ __('Force Delete') }}</button>
          </form>
          </div>
        </div>
      </div>
  </section>

  @endforeach

  @if (count($graduates) == 0)

  <div class="alert alert-danger mt-2" role="alert">
      <strong>{{ __('No deleted graduates.') }}</strong>
  </div>

  @endif

  {{ $graduates->onEachSide(1)->links() }}

</section>

@endsection