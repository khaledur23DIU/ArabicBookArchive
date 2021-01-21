@extends('layouts.backend.app')

@section('title', __('User Profile'))

@push('css')
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2-materialize.css')}}" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-account-settings.min.css')}}">
@endpush

@section('content')

<section class="tabs-vertical mt-1 section">
  <div class="row">
    <div class="col l4 s12">
      <!-- tabs  -->
      <div class="card-panel">
        <ul class="tabs">
          <li class="tab">
            <a href="#general">
              <i class="material-icons">brightness_low</i>
              <span>{{__('General')}}</span>
            </a>
          </li>
          <li class="tab">
            <a href="#change-password">
              <i class="material-icons">lock_open</i>
              <span>{{__('Change Password')}}</span>
            </a>
          </li>
          <li class="tab">
            <a href="#info">
              <i class="material-icons">error_outline</i>
              <span> {{__('Info')}}</span>
            </a>
          </li>
          <li class="tab">
            <a href="#social-link">
              <i class="material-icons">chat_bubble_outline</i>
              <span>{{__('Social Links')}}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="col l8 s12">
      <!-- tabs content -->
      <div id="general">
        <div class="card-panel">
          <div class="divider mb-1 mt-1"></div>
          <form class="formValidate" method="POST" action="{{ route('profile.updateBasicInfo',$user->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <label for="name">{{ __('User Name') }}</label>
                  <input id="name" name="name" type="text" value="{{$user->name}}" class="validate @error('name') is-invalid @enderror" data-error=".errorTxt2">
                  <small class="red-text errorTxt2"></small>
                  @error('name')
                  <small class="red-text errorTxt2">{{ __($message) }}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <label for="email">{{ __('E-Mail Address') }}</label>
                  <input id="email" type="email" name="email" readonly="true"  value="{{$user->email}}">
                  
                </div>
              </div>
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2">
                  {{__('Save changes')}}
                </button>
                <button type="reset" class="btn btn-light-pink waves-effect waves-light">{{__('Cancel')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="change-password">
        <div class="card-panel">
          <form class="paaswordvalidate" action="{{ route('profile.updateUserPassword',$user->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <input id="password" name="current_password" class="validate @error('current_password') is-invalid @enderror" type="password" autocomplete="current_password" data-error=".errorTxt4">
                  <label for="password">{{__('Current Password')}}</label>
                  <small class="red-text errorTxt4"></small>
                  @error('current_password')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="new_password" name="new_password" type="password" autocomplete="current_password" class="validate @error('new_password') is-invalid @enderror" data-error=".errorTxt5">
                  <label for="new_password">{{('New Password')}}</label>
                  <small class="red-text errorTxt5"></small>
                  @error('new_password')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="confirm_password" type="password" name="new_confirm_password" class="validate @error('new_confirm_password') is-invalid @enderror" autocomplete="current_password" data-error=".errorTxt6">
                  <label for="confirm_password">{{__('Retype New Password')}}</label>
                  <small class="red-text errorTxt6"></small>
                  @error('new_confirm_password')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-1">{{__('Save changes')}}</button>
                <button type="reset" class="btn btn-light-pink waves-effect waves-light">{{__('Cancel')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="info">
        <div class="card-panel">
          <form class="infovalidate" action="{{ route('profile.updateUserInfo',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <textarea class="materialize-textarea" class="validate @error('bio') is-invalid @enderror" id="bio" name="bio"
                    placeholder="Your Bio data here...">{!! $user->profile->bio !!}</textarea>
                  <label for="bio">{{__('Bio')}}</label>
                  @error('bio')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="birth_date" name="birth_date" type="text" value="{{\Carbon\Carbon::parse($user->profile->birth_date)->format('d/m/Y')}}" class="birthdate-picker datepicker @error('birth_date') is-invalid @enderror">
                  <label for="birth_date">{{__('Birth date')}}</label>
                  @error('birth_date')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="phone" name="phone" value="{{$user->profile->phone}}" type="text" class="validate @error('phone') is-invalid @enderror">
                  <label for="phone">{{__('Phone')}}</label>
                  @error('phone')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="website" name="website" type="url" value="{{$user->profile->website}}" class="validate @error('website') is-invalid @enderror">
                  <label for="website">{{__('Website')}}</label>
                  @error('website')
                  <small class="red-text errorTxt4">{{$message}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2">{{__('Save
                                                                                  changes')}}</button>
                <button type="reset" class="btn btn-light-pink waves-effect waves-light ">{{__('Cancel')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="social-link">
        <div class="card-panel">
          <form action="{{ route('profile.updateUserSocialLink',$user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <input id="facebook" name="facebook" type="url" value="{{$user->profile->facebook}}" class="validate @error('facebook') is-invalid @enderror" placeholder="{{__('Add link')}}">
                  <label for="facebook">{{__('Facebook')}}</label>
                  @error('facebook')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="google" type="url" name="google" value="{{$user->profile->google_plus}}" class="validate @error('google') is-invalid @enderror" placeholder="{{__('Add link')}}">
                  <label for="google">{{__('Google')}}+</label>
                  @error('google')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="linkedIn" type="url" name="linkedIn" value="{{$user->profile->linkedin}}" class="validate @error('linkedIn') is-invalid @enderror" placeholder="{{__('Add link')}}">
                  <label for="linkedIn">{{__('LinkedIn')}}</label>
                  @error('linkedIn')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="instagram" type="url" name="instagram" value="{{$user->profile->instagram}}" class="validate @error('instagram') is-invalid @enderror" placeholder="{{__('Add link')}}">
                  <label for="instagram">{{__('Instagram')}}</label>
                  @error('instagram')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="quora" type="url" name="quora" value="{{$user->profile->quora}}" class="validate @error('quora') is-invalid @enderror" placeholder="{{__('Add link')}}">
                  <label for="quora">{{__('Quora')}}</label>
                  @error('quora')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2">{{__('Save
                                                                                  changes')}}</button>
                <button type="reset" class="btn btn-light-pink waves-effect waves-light">{{__('Cancel')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('js')
	<script src="{{asset('assets/backend/app-assets/vendors/select2/select2.full.min.js')}}"></script>
	<script src="{{asset('assets/backend/app-assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
  	<script src="{{asset('assets/backend/app-assets/js/scripts/page-account-settings.min.js')}}"></script>

@endpush
