@extends('layouts.backend.app')

@section('title', __('Create New User'))

@push('css')
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2-materialize.css')}}" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
@endpush

@section('content')
<div class="section users-edit">
  <div class="card">
    <div class="card-content">
      <!-- <div class="card-body"> -->
      <ul class="tabs mb-2 row">
        <li class="tab">
          <a class="display-flex align-items-center active" id="account-tab" href="#account">
            <i class="material-icons mr-1">person_outline</i><span>{{__('Account Info')}}</span>
          </a>
        </li>
      </ul>
      <div class="divider mb-3"></div>
      <div class="row">
        <div class="col s12" id="account">
          <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
          	@csrf
            <div class="row">
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12 input-field">
                    <input id="name" name="name" type="text" class="validate @error('name') is-invalid @enderror" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="{{__('User name')}}" required 
                      data-error=".errorTxt1">
                    <label for="name">{{ __('Name') }}</label>
                    @error('name')
                    <small class="red-text errorTxt1">{{ __($message) }}</small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="email" name="email" type="email" class="validate @error('email') is-invalid @enderror" value="{{ old('email') }}" autocomplete="email" placeholder="{{__('User Email')}}" required 
                      data-error=".errorTxt4">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <small class="errorTxt2"></small>
                    @error('email')
                    <small class="red-text errorTxt4">{{ __($message) }}</small>
                    @enderror
                  </div>
                  <div class="col s12 input-field" class="validate @error('roles') is-invalid @enderror">
                    <select id="roles" name="roles[]" multiple="multiple">
                      	<option disabled="true" value="">{{__('Select State')}}</option>
                      @foreach ($roles as $role)  
                      	<option value="{{$role->id}}"> {!! $role->name !!} </option>
                      @endforeach
                    </select>
                    <label for="roles">{{ __('Roles') }}</label>
                    @error('roles')
                    <small class="red-text errorTxt4">{{ __($message) }}}</small>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12 input-field">
                    <input id="password" name="password" type="password" class="validate @error('password') is-invalid @enderror" autocomplete="new-password" placeholder="{{__('Password')}}" required
                      data-error=".errorTxt4">
                    <label for="password">{{ __('Password') }}</label>
                    @error('password')
                    <small class="red-text errorTxt4">{{ __($message) }}}</small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="confirm-password" name="confirm-password" type="password" class="validate" autocomplete="new-password" placeholder="{{__('Retype Password')}}" required
                      data-error=".errorTxt4">
                    <label for="confirm-password">{{ __('Confirm Password') }}</label>
                    <small class="red-text errorTxt4"></small>
                  </div>
                  <div class="col s12 input-field">
                    <select id="status" name="status" class="validate @error('status') is-invalid @enderror">
                      <option disabled="true" value="">{{__('Select a state')}}</option>
                      <option value="1">{{__('Active')}}</option>
                      <option value="0">{{__('Close')}}</option>
                    </select>
                    <label for="status">{{ __('Status') }}</label>
                    @error('status')
                    <small class="red-text errorTxt4">{{__($message)}}</small>
                    @enderror
                  </div>
                </div>
              </div>
              
              <div class="col s12 display-flex justify-content-end mt-3">
                <button type="submit" class="btn indigo">
                  {{ __('Save') }}</button>
                <button type="button" class="btn btn-light">{{ __('Cancel') }}</button>
              </div>
            </div>
          </form>
          <!-- users edit account form ends -->
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
</div>
@endsection

@push('js')
	<script src="{{asset('assets/backend/app-assets/vendors/select2/select2.full.min.js')}}"></script>
	<script src="{{asset('assets/backend/app-assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
  	<script src="{{asset('assets/backend/app-assets/js/scripts/page-users.min.js')}}"></script>

@endpush
