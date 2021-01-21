@extends('layouts.auth.app')

@section('content')
<div class="container">
          <div id="login-page" class="row">
          <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form class="login-form" action="{{ route('password.email') }}" method="POST">
                @csrf
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
              
              <div class="row">
                <div class="input-field col s12">
                  <button type="submit"class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">{{__('Send Password Reset Link')}}</button>
                </div>
              </div>
            </form>
          </div>
          </div>
        </div>
@endsection



