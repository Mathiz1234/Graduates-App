
@extends('layout')

@section('content')

<section class="row justify-content-center">

    <div class="card my-2 col col-lg-6">
        <div class="card-header">
        Twoje dane osobowe:
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Imię: {{ auth()->user()->name }}</li>
        <li class="list-group-item">Adres e-mail: {{ auth()->user()->email }}
            @if (auth()->user()->ifEmailVerify())
                <span class="badge badge-success ml-1 text-uppercase">ZWERYFIKOWANY</span></li>
            @else
                <span class="badge badge-danger ml-1 text-uppercase">NIE ZWERYFIKOWANY</span></li>
            @endif
        <li class="list-group-item text-muted">Konto utworzone: {{ auth()->user()->created_at }}</li>
        <li class="list-group-item"><a href="{{ url('account/change') }}" class="btn btn-primary text-uppercase">Zmień dane</a></li>
        <li class="list-group-item"><a href="{{ url('account/change/password') }}" class="btn btn-primary text-uppercase">Zmień hasło</a></li>
    </ul>
    </div>

</section>

@endsection