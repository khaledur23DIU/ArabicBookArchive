@extends('layouts.auth.app')

@section('content')
<div class="container">
          <div id="login-page" class="row">
          <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            <form class="login-form" action="{{ route('password.confirm') }}" method="POST">
                @csrf
              <div class="row">
                <div class="input-field col s12">
                  <h5 class="ml-4">{{__('Confirm Password')}}</h5>
                </div>
              </div>
              <div class="row margin">
                {{ __('Please confirm your password before continuing.') }}
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
                <div class="input-field col s12">
                  <button type="submit"class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">{{__('Confirm Password')}}</button>
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

