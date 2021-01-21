@extends('layouts.auth.app')
@section('title', 'Login')
@section('content')

        <div class="container">
          <div id="login-page" class="row">
          <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            <form class="login-form" action="{{ route('login') }}" method="POST">
                @csrf
              <div class="row">
                <div class="input-field col s12">
                  <h5 class="ml-4">{{__('Login')}}</h5>
                </div>
              </div>
              <div class="row margin">
                <div class="input-field col s12">
                  <i class="material-icons prefix pt-2">person_outline</i>
                  <input id="email" name="email" type="email" autofocus="email" value="{{ old('email') }}" autocomplete="email" required class="validate @error('email') is-invalid @enderror">
                  <label for="email" class="center-align">{{ __('E-Mail Address') }}</label>
                  @error('email')
                <span class="invalid-feedback" role="alert">
                    <small class="red-text">{{ $message }}</small>
                </span>
                @enderror
                </div>
              </div>
                
              <div class="row margin">
                <div class="input-field col s12">
                  <i class="material-icons prefix pt-2">lock_outline</i>
                  <input id="password" type="password" name="password" class="validate @error('password') is-invalid @enderror" required autocomplete="current-password">
                  <label for="password">{{ __('Password') }}</label>
                  @error('password')
                <span class="invalid-feedback" role="alert">
                    <small class="red-text">{{ $message }}</small>
                </span>
                @enderror
                </div>
                
              </div>
              <div class="row">
                <div class="col s12 m12 l12 ml-2 mt-1">
                  <p>
                    <label for="remember">
                      <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                      <span>{{ __('Remember Me') }}</span>
                    </label>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <button type="submit"class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">{{__('Login')}}</button>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12 m12">
                  <p class="margin right-align medium-small">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                         {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    </p>
                </div>

              </div>
            </form>
          </div>
          </div>
        </div>

@endsection