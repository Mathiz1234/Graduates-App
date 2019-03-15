
@extends('layout')

@section('content')

{{-- Search bar --}}

<div class="row justify-content-center mt-3 filters sticky-top">
    <div class="col text-center">
    <button class="d-inline-block d-lg-none btn btn-primary mb-1" type="button" data-toggle="collapse" data-target="#collapseSearchBar" aria-expanded="false" aria-controls="collapseSearchBar">
            Filtry
    </button>
            <div class="collapse" id="collapseSearchBar">
            <div class="card card-body">
                <form>
                    <div class="form-row text-left">
                        <div class="form-group col">
                            <label for="inputName">Imię</label>
                            <input type="text" class="form-control" id="inputName" placeholder="Imię">
                        </div>
                        <div class="form-group col">
                                <label for="inputSurname">Nazwisko</label>
                                <input type="text" class="form-control" id="inputSurname" placeholder="Nazwisko">
                        </div>
                        <div class="form-group col">
                                <label for="inputMatureYear">Rok matury</label>
                                <input type="number" min="1874" max="2099" step="1" class="form-control" id="inputMatureYear" placeholder="Rok matury">
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search mr-2"></i>Szukaj</button>
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
            <p class="card-text"><small class="text-muted">Dodany {{ $graduate->created_at }}</small></p>
            <p class="card-text"><small class="text-muted">Ostatnia aktułalizacja {{ $graduate->updated_at }}</small></p>
            </div>
          </div>
        </div>
    </section>

    @endforeach

    {{ $graduates->onEachSide(1)->links() }}

</section>

@endsection