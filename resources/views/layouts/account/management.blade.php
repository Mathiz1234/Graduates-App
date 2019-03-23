
@extends('layout')

@section('content')

@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show my-1" role="alert">
            <i class="fas fa-exclamation-circle"></i> {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif

<section class="row justify-content-center">
    <div class="col col-lg-10 accordion my-1" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link text-uppercase" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Typ konta używkownik
                </button>
            </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                Użytkownik może przeglądać całą baze danych (udostępnionych i nie udostępnionych) absolwentów.
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed text-uppercase" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Typ konta moderator
                </button>
            </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                Moderator posiada uprawnienia użytkownika oraz może dodawać, zmieniać i usuwać (do kosza) absolwentów.
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed text-uppercase" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Typ konta administrator
                </button>
            </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                    Administrator posiada uprawnienia moderatora oraz może na stałe usuwać absolwentów z bazy danych oraz może nadawać uprawnienia innym uzytkownikom.
                </div>
            </div>
        </div>
    </div>
</section>

<section class="row justify-content-center">

    <div class="card my-1 col col-lg-10">
        <div class="card-header text-center">
            <h4>Spis użytkowników:</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imię</th>
                            <th scope="col">Email</th>
                            <th scope="col">Rodzaj</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @switch ($user->role)
                                        @case (1)
                                            Użytkownik
                                        @break
                                        @case (2)
                                            Moderator
                                        @break
                                        @case (3)
                                            Administrator
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('account/management') }}">
                                        @csrf
                                        <input type="hidden" name="promotion" value="up">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-outline-primary  data-toggle="tooltip" data-placement="top" title="Zwiększ uprawnienia" {{ $user->role == 3 ? 'disabled' : '' }}>
                                            <i class="fas fa-level-up-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('account/management') }}">
                                        @csrf
                                        <input type="hidden" name="promotion" value="down">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="Zmiejsz uprawnienia" {{ $user->role == 1 ? 'disabled' : '' }}>
                                            <i class="fas fa-level-down-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
    </ul>
    </div>

</section>

@endsection