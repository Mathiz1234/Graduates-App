
@extends('layout')

@section('content')

<div class="row justify-content-center mt-3">
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

@endsection