
@extends('layout')

@section('content')

<div class="card mt-2">
    <div class="card-body">
        <form method="POST" action="{{ url('/graduates') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputName">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="inputName" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group col-md-6">
                <label for="inputSurname">{{ __('Surname') }}</label>
                <input type="text" name="surname" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" id="inputSurname" placeholder="{{ __('Surname') }}" value="{{ old('surname') }}" required>
                @if ($errors->has('surname'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('surname') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputMaturaYear">{{ __('Matura year') }}</label>
              <input type="number" min="1874" max="2155" name="matura_year" class="form-control{{ $errors->has('matura_year') ? ' is-invalid' : '' }}" id="inputMaturaYear" placeholder="{{ __('Matura year') }}" value="{{ old('matura_year') }}" required>
                @if ($errors->has('mature_year'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('mature_year') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="textareades">{{ __('Description') }}</label>
                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="textareades" rows="15">{{ old('description') }}</textarea>
                @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>
            <div class="custom-control custom-checkbox">
                <input name="shared" type="checkbox" class="custom-control-input" id="ifShared">
                <label class="custom-control-label" for="ifShared">{{ __('If checked graduate will be shared') }}</label>
              </div>
            <div class="form-group">
                <label for="inputfile">{{ __('Choose custom avatar') }} (max. 2MB, 100x100px)</label>
                <input name="avatar" type="file" class="form-control-file{{ $errors->has('avatar') ? ' is-invalid' : '' }}" id="inputfile">
                @if ($errors->has('avatar'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('avatar') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="inputfiles">{{ __('Choose files/scans (jpeg, png, bmp, gif, or svg)') }} max. 4MB</label>
                <input name="scans[]" type="file" class="form-control-file{{ $errors->has('scans.*') ? ' is-invalid' : '' }}" id="inputfiles" multiple>
                @if ($errors->has('scans.*'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('scans.*') }}</strong>
                </span>
                @endif
            </div>

            <button type="submit" class="btn btn-primary mt-1"><i class="fas fa-plus"></i> {{ __('Create') }}</button>


            {{-- <div class="input-group control-group increment" >
                <input type="file" name="filename[]" class="form-control">
                <div class="input-group-btn">
                  <button class="btn btn-success add" type="button"><i class="fas fa-plus"></i> Add</button>
                </div>
            </div>
            <div class="clone" hidden>
                <div class="input-group control-group mt-2">
                  <input type="file" name="filename[]" class="form-control">
                  <div class="input-group-btn">
                    <button class="btn btn-danger remove" type="button"><i class="fas fa-trash-alt"></i> Remove</button>
                  </div>
                </div>
            </div> --}}
        </form>

    </div>
</div>

@endsection