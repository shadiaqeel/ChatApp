@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center">
            <div class="card  card-sign my-5">
                <h5 class=" card-title text-center">{{ __('Sign in') }}</h5>

                <div class="card-body">

                    <form class="form-sign" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group  row justify-content-center">

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>




                        <div class="form-group  row justify-content-center ">

                                <input id="password" type="password" class=" form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>








                        <div class="form-group row mb-0 justify-content-center">
                                <button type="submit" class="btn btn-lg btn-primary btn-block text-uppercase">
                                    {{ __('Login') }}
                                </button>
                                </div>
                                <div class="form-group row mb-0 justify-content-center">

                                @if (Route::has('password.request'))
                                    <a class=" btn-link  " href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
</div>

                        </div>
                    </form>
                </div>
            </div>

    </div>
</div>


@endsection
