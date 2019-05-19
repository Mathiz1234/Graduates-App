
@extends('layout')

@section('content')

<section class="card mt-2">
    <div class="card-body">
        <form method="POST" action="{{ url('/graduates/'.$graduate->id) }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PATCH')
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputName">{{ __('Name') }}</label>
                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="inputName" placeholder="{{ __('Name') }}" value="{{ old('name', $graduate->name) }}" required autofocus>
                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group col-md-6">
                <label for="inputSurname">{{ __('Surname') }}</label>
                <input type="text" name="surname" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" id="inputSurname" placeholder="{{ __('Surname') }}" value="{{ old('surname', $graduate->surname) }}" required>
                @if ($errors->has('surname'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('surname') }}</strong>
                </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="inputMaturaYear">{{ __('Matura year') }}</label>
              <input type="number" min="1874" max="2155" name="matura_year" class="form-control{{ $errors->has('matura_year') ? ' is-invalid' : '' }}" id="inputMaturaYear" placeholder="{{ __('Matura year') }}" value="{{ old('matura_year', $graduate->matura_year) }}" required>
                @if ($errors->has('mature_year'))
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('mature_year') }}</strong>
                </span>
                @endif
            </div>
            <div class="form-group">
                <label for="textareades">{{ __('Description') }}</label>
                <textarea name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" id="textareades" rows="15">{{ old('description', $graduate->description) }}</textarea>
                @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>
            <div class="custom-control custom-checkbox">
                <input name="shared" type="checkbox" class="custom-control-input" id="ifShared" {{ $graduate->shared ? 'checked' : ''}}>
                <label class="custom-control-label" for="ifShared">{{ __('If checked graduate will be shared') }}</label>
              </div>

            <hr>
            <section id="old-avatar-section" class="row no-gutters justify-content-center">
                <header><h4 class="text-muted">{{__('Avatar')}} :</h4></header>
                <div class="w-100"></div>
                <div class="col-4 col-lg-2 d-flex align-items-start graduate-card__avatar m-2">
                    <img src="{{ asset('storage/avatars/'.$graduate->avatar) }}" class="card-img p-1" alt="avatar">
                </div>
                <div class="d-flex align-items-center justify-content-center m-2">
                    <button type="button" id="delete_avatar" class="btn btn-danger mt-1"><i class="fas fa-trash"></i> {{ __('Delete') }}</button>
                    <input name="if-avatar-deleted" value="false" hidden>
                </div>
            </section>

            <div id="new-avatar-section" style="display: none;" class="form-group">
                    <label for="inputfile">{{ __('Choose custom avatar') }} (max. 2MB, 100x100px)</label>
                    <input name="avatar" type="file" class="form-control-file{{ $errors->has('avatar') ? ' is-invalid' : '' }}" id="inputfile">
                    @if ($errors->has('avatar'))
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                    @endif
            </div>

            @if($graduate->files->count())

            <ul class="list-group mb-2">
                <a href="#" class="list-group-item list-group-item-action disabled" aria-disabled="true" tabindex="-2">
                    {{ __('List of .pdf files') }}:
                </a>
                @foreach ($graduate->files as $file)
                <li class="list-group-item list-group-item-action">
                <a href="{{ asset('storage/files/'.$file->image_url) }}" target="_blank">{{ $file->filename }}</a>
                <button type="button" class="btn btn-danger ml-1 files-delete-button"><i class="fas fa-trash"></i> {{ __('Delete') }}</button>
                <input type="text" name="old-files[]" value="{{$file->id}}" hidden>
                </li>
                @endforeach
            </ul>

            @endif

            <hr>

            @if($graduate->scans->count())
            <section>
                <p>{{__('Click the image you want to delete')}}</p>
                <div class="card graduate-card">
                    <div class="card-body row">
                    @foreach ($graduate->scans as $scan)
                    <div style="max-height: 400px; overflow:hidden; display:flex;" class="col-12 col-lg-6 p-1 graduate-card__img align-items-center">
                        <img src="{{ asset('storage/scans/'.$scan->image_url) }}" class="graduate-card__img--file img-fluid rounded border border-success" alt="@lang('general.scan')">
                        <a class="graduate-card__img--link graduate-card_img--delete" href="#">{{__('Delete')}}<i class="fas fa-trash"></i></a>
                        <input type="text" name="old-scans[]" value="{{$scan->id}}" hidden>
                    </div>
                    @endforeach
                    </div>
                </div>
            </section>
            @endif

            <div class="form-group mt-3">
              <p>{{ __('Choose files/scans (pdf, jpeg, png, bmp, gif, or svg)') }} max. 4MB</p>
              <div class="input-group mb-2 increment" >
                  <input type="file" name="scans[]" class="form-control">
                  <div class="input-group-btn">
                    <button class="btn btn-success addFormButton" type="button"><i class="fas fa-plus"></i> {{ __('Add') }}</button>
                  </div>
              </div>
              <div id="clone" hidden>
                  <div class="input-group control-group mt-2">
                    <div class="input-group-btn">
                      <button class="btn btn-danger removeFormButton" type="button"><i class="fas fa-trash-alt"></i> {{ __('Remove') }}</button>
                    </div>
                  </div>
              </div>
            </div>

            @if ($errors->has('scans.*'))
            <div>
                  <span style="width: 100%;margin-top: 0.25rem;font-size: 80%;color: #e3342f;" role="alert">
                  <strong>{{ $errors->first('scans.*') }}</strong>
                  </span>
            </div>
            @endif

            <button type="submit" class="btn btn-primary mt-1"><i class="fas fa-edit"></i> {{ __('Edit') }}</button>
        </form>

    </div>
</section>

@endsection