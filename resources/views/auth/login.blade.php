@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="padding: 0px;">
        <div class="col-md-6 col-lg-6">
           
                <div style="text-align: center; margin-top: 20px;" class="mt-6"><h3>{{ __('Login') }}</h3> </div>

                <div class="container mt-6">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group ">
                            

                            <div class="">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Username" style="border-radius: 15px;">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
    
                            <div class="">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" style="border-radius: 15px;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group ">
                            <div class="">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" checked="">

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group  mb-0">
                            <div class="">
                                <button type="submit" class="btn btn-secondary btn-lg btn-block btn-xtrm">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
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
