@extends('layouts.auth.app')

@section('content')
<div class="container">
          <div id="login-page" class="row">
          <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            <form class="login-form" action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
              <div class="row">
                <div class="input-field col s12">
                  <h5 class="ml-4">{{__('Reset Password')}}</h5>
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
                  <input id="password" type="password" name="password" class="validate @error('password') is-invalid @enderror" required autocomplete="new-password">
                  <label for="password">{{ __('Password') }}</label>
                  @error('password')
                <span class="invalid-feedback" role="alert">
                    <small class="red-text">{{ $message }}</small>
                </span>
                @enderror
                </div>
              </div>

              <div class="row margin">
                <div class="input-field col s12">
                  <i class="material-icons prefix pt-2">lock_outline</i>
                  <input id="password-confirm" type="password" name="password_confirmation" class="validate" required autocomplete="new-password">
                  <label for="password-confirm">{{ __('Password') }}</label>
                </div>
              </div>

              <div class="row">
                <div class="input-field col s12">
                  <button type="submit"class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">{{__('Reset Password')}}</button>
                </div>
              </div>
            </form>
          </div>
          </div>
        </div>
@endsection

