@extends('layouts.app')

@section('content')

<div class="sl-mainpanel">

  <div class="sl-pagebody">
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Changez Votre Mot de Passe') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf


                        <div class="form-group row">
                            <label for="oldpass" class="col-md-4 col-form-label text-md-right">{{ __('Ancien mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="oldpass" type="password" class="form-control{{ $errors->has('oldpass') ? ' is-invalid' : '' }}" name="oldpass" value="{{ $oldpass ?? old('oldpass') }}" required autofocus>

                                @if ($errors->has('oldpass'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('oldpass') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nouveau mot de Passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmez mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="float:right">
                                    {{ __('Renitialiser le mot de passe') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
  </div>


    </div>
</div>
@endsection
