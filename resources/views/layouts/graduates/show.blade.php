
@extends('layout')

@section('content')

{{-- Graduate table --}}

<section class="card my-2 shadow-sm rounded graduate-card">
    <div class="row no-gutters">
      <div class="col-4 col-lg-2 d-flex align-items-start graduate-card__avatar">
        <img src="{{ asset('img/avatars/'.$graduate->avatar) }}" class="card-img p-1" alt="avatar">
      </div>
      <div class="col-8 col-lg-10 graduate-card__text">
        <div class="card-body">
        <p class="card-text">Imię: <strong>{{ $graduate->name }}</strong></p>
        <p class="card-text">Nazwisko: <strong>{{ $graduate->surname }}</strong></p>
        <p class="card-text">Rok matury: <strong>{{ $graduate->mature_year }}</strong></p>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="graduate-card__text p-1 text-justify">
            <div class="card-body">
            <p class="card-text">Opis: {{ $graduate->description }}</p>
            <p class="card-text"><small class="text-muted">Dodany {{ $graduate->created_at }}</small></p>
            <p class="card-text"><small class="text-muted">Ostatnia aktułalizacja {{ $graduate->updated_at }}</small></p>
            </div>
          </div>
    </div>
</section>

@if($graduate->images->count())
<section>
    <div class="card graduate-card">
        <div class="card-body row">
          @foreach ($graduate->images as $image)
          <div class="col-12 col-lg-6 p-1 graduate-card__img d-flex align-items-center" style="max-height: 400px; overflow:hidden;">
            <img src="{{ asset('img/scans/'.$image->image_url) }}" class="graduate-card__img--file img-fluid rounded border border-success" alt="Skany">
            <a class="graduate-card__img--link" href="{{ asset('img/scans/'.$image->image_url) }}" target="_blank">KLIK <i class="fas fa-hand-pointer"></i></a>
          </div>
          @endforeach
        </div>
      </div>
</section>
@endif

<section class="d-flex my-2 justify-content-center">
    <a href="{{ url('graduates') }}" class="btn btn-primary mx-2">WRÓĆ</a>
    @can('change', $graduate)
    <a href="{{ url('graduates/'.$graduate->id.'/edit') }}" class="btn btn-primary mx-2">EDYCJA</a>
    <form class="d-inline-block mx-2" method="POST" action="{{ url('graduates/'.$graduate->id) }}">
        @method('DELETE')

        @csrf
    <button type="submit" class="btn btn-primary">USUŃ</button>
  </form>
  @endcan
</section>

@endsection