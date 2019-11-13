
@extends('layout')

@section('title', __('titles.manage').' - '.__('general.graduate'))

@section('content')

@include('session-status')

<section class="row justify-content-center">
    <div class="col col-lg-10 accordion my-1" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
            <h2 class="mb-0">
                <button class="btn btn-link text-uppercase" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{ __('User account type') }}
                </button>
            </h2>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="card-body">
                {{ __('The user can browse the entire database (shared and not shared) of graduates.') }}
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed text-uppercase" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    {{ __('Moderator account type') }}
                </button>
            </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
                {{ __("The moderator has the user's authority and can add, change and delete (into the bin) graduates.") }}
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed text-uppercase" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                 {{ __('Administrator account type') }}
                </button>
            </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
            <div class="card-body">
                    {{ __("The administrator has moderator's authority and can permanently remove graduates from the database and may grant authority to other users.") }}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="row justify-content-center">

    <div class="card my-1 col col-lg-10">
        <div class="card-header text-center">
            <h4>{{ __('List of users') }}:</h4>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Email') }}</th>
                            <th scope="col">{{ __('Type') }}</th>
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
                                        @case (0)
                                        {{ __('Banned account') }}
                                        @break
                                        @case (1)
                                        {{ __('User') }}
                                        @break
                                        @case (2)
                                        {{ __('Moderator') }}
                                        @break
                                        @case (3)
                                        {{ __('Administrator') }}
                                        @break
                                    @endswitch
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('account/management') }}">
                                        @csrf
                                        <input type="hidden" name="promotion" value="up">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-outline-primary"  data-toggle="tooltip" data-placement="top" title="{{ __('Increase permissions') }}" {{ $user->role == 3 ? 'disabled' : '' }}>
                                            <i class="fas fa-level-up-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{{ url('account/management') }}">
                                        @csrf
                                        <input type="hidden" name="promotion" value="down">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <button type="submit" class="btn btn-outline-primary" data-toggle="tooltip" data-placement="top" title="{{ __('Decrease permissions') }}" {{ $user->role == 0 ? 'disabled' : '' }}>
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