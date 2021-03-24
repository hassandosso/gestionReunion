@extends('layouts.app')

@section('content')

        <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Bienvenu <span class="tx-info tx-normal">Gestion Reunion</span></div>
        <div class="tx-center mg-b-60">TANAN MOUHELA</div>

        <form action="{{route('login')}}" class="d-block" method="post">
            @csrf
        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
           required autocomplete="email" autofocus placeholder="Email Address">

       @error('email')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
       @enderror
        </div><!-- form-group -->
        <div class="form-group">
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
              @error('password')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
        <a href="{{ route('password.request') }}" class="text-blue">I forgot my password</a>
        </div><!-- form-group -->
        <button type="submit" class="btn btn-info btn-block">Sign In</button>
      </form>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->
@endsection
