
@extends('layout')

@section('content')


<div class="jumbotron mt-3">
        <h1 class="display-4">System absolwentów! - W BUDOWIE </h1>
        <p class="lead">Przeszukuj spis absolwentów szkoły Staszica! Teraz to bardzo proste!</p>
        <hr class="my-4">
        <p>Aby w pełni moc korzystać z usługi, zaloguj się.</p>
        <a class="btn btn-primary btn-lg" href="{{route('graduates.index')}}" role="button">Przeszukaj teraz!</a>
</div>

@endsection