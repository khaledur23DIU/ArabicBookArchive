@extends('layouts.backend.app')

@section('title', __('Site Settings'))

@push('css')
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2.min.css')}}" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/form-select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2-materialize.css')}}" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-account-settings.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/form-wizard.min.css')}}">
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
            <a href="#language">
              <i class="material-icons">language</i>
              <span>{{__('Site Language')}}</span>
            </a>
          </li>
          <li class="tab">
            <a href="#meta">
              <i class="material-icons">api</i>
              <span>{{__('Meta Settings')}}</span>
            </a>
          </li>
          <li class="tab">
            <a href="#mail-service">
              <i class="material-icons">alternate_email</i>
              <span>{{__('Mail Settings')}}</span>
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
          <form class="formValidate" method="POST" action="{{ route('siteSetting.updateBasicInfo') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <label for="site_name">{{ __('Site Name') }}</label>
                  <input id="site_name" name="site_name" type="text" value="{{$settings->site_name}}" class="validate @error('site_name') is-invalid @enderror" data-error=".errorTxt2">
                  <small class="red-text errorTxt2"></small>
                  @error('site_name')
                  <small class="red-text errorTxt2">{{ __($message) }}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <label for="email">{{ __('Site Email Address') }}</label>
                  <input id="email" type="email" name="site_email" class="validate @error('site_email') is-invalid @enderror" value="{{$settings->site_email}}">
                  @error('site_email')
                  <small class="red-text errorTxt2">{{ __($message) }}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="site_address" name="site_address" type="url" value="{{$settings->site_address}}" class="validate @error('site_address') is-invalid @enderror">
                  <label for="site_address">{{ __('Site URL') }}</label>
                  @error('site_address')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
              <div class="input-field">
                  <label for="footer_text">{{ __('Footer Text') }}</label>
                  <input id="footer_text" name="footer_text" type="text" value="{!!$settings->footer_text!!}" class="validate @error('footer_text') is-invalid @enderror" data-error=".errorTxt2">
                  <small class="red-text errorTxt2"></small>
                  @error('footer_text')
                  <small class="red-text errorTxt2">{{ __($message) }}</small>
                  @enderror
              </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <textarea class="materialize-textarea" class="validate @error('site_description') is-invalid @enderror" id="site_description" name="site_description"
                    placeholder="{{__('Site description here...')}}">{!! $settings->site_description !!}</textarea>
                  <label for="site_description">{{ __('Site Description') }}</label>
                  @error('site_description')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
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
      <div id="language">
        <div class="card-panel">
          <form class="paaswordvalidate" action="{{ route('siteSetting.language')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col s12">
                <div class="select-wraper">
                  <label for="language">{{ __('Site Language') }}</label>
                  <select class="select2 browser-default" id="language" name="language">
                  <option value="0" disabled selected>{{__('Choose Language')}}</option>
                  @foreach ($languages as $language)
                  <option {{$language->is_active == 1 ? 'selected':''}} value="{{$language->id}}">{{$language->site_language}}</option>
                  @endforeach
                  </select>
                  @error('language')
                  <small class="red-text errorTxt2">{{ __($message) }}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12"></div>
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-1">{{__('Save changes')}}</button>
                <button type="reset" class="btn btn-light-pink waves-effect waves-light">{{__('Cancel')}}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div id="meta">
        <div class="card-panel">
          <form class="paaswordvalidate" action="{{ route('siteSetting.updateMeta')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <label for="meta_title">{{ __('Site Meta Title') }}</label>
                  <input id="meta_title" name="meta_title" type="text" value="{{$settings->meta_title}}" class="validate @error('meta_title') is-invalid @enderror" data-error=".errorTxt2">
                  <small class="red-text errorTxt2"></small>
                  @error('meta_title')
                  <small class="red-text errorTxt2">{{ __($message) }}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <textarea class="materialize-textarea" class="validate @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description"
                    placeholder="{{__('Site meta description here...')}}">{!! $settings->meta_description !!}</textarea>
                  <label for="meta_description">{{ __('Site Meta Description') }}</label>
                  @error('meta_description')
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
      <div id="mail-service">
        <div class="card-panel">
          <form class="infovalidate" action="{{ route('siteSetting.updateMailService') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col s12">
                <div class="input-field">
                  <input id="driver" name="driver" value="{{$mailSettings->driver}}" type="text" class="validate @error('driver') is-invalid @enderror">
                  <label for="driver">{{__('Mail Driver')}}</label>
                  @error('driver')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="host" name="host" value="{{$mailSettings->host}}" type="text" class="validate @error('host') is-invalid @enderror">
                  <label for="host">{{__('Mail Host')}}</label>
                  @error('host')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="port" name="port" value="{{$mailSettings->port}}" type="number" min="0" class="validate @error('port') is-invalid @enderror">
                  <label for="port">{{__('Mail Port')}}</label>
                  @error('port')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="username" name="username" value="{{$mailSettings->username}}" type="text" class="validate @error('username') is-invalid @enderror">
                  <label for="username">{{__('User Name')}}</label>
                  @error('username')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="password" name="password" type="password" class="validate @error('password') is-invalid @enderror">
                  <label for="password">{{__('Password')}}</label>
                  @error('password')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="mail_encryption" name="mail_encryption" value="{{$mailSettings->mail_encryption}}" type="text" class="validate @error('mail_encryption') is-invalid @enderror">
                  <label for="mail_encryption">{{__('Encryption Type')}}</label>
                  @error('mail_encryption')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="from_address" name="from_address" value="{{$mailSettings->from_address}}" type="text" class="validate @error('from_address') is-invalid @enderror">
                  <label for="from_address">{{__('From Address')}}</label>
                  @error('from_address')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12">
                <div class="input-field">
                  <input id="from_name" name="from_name" value="{{$mailSettings->from_name}}" type="text" class="validate @error('from_name') is-invalid @enderror">
                  <label for="from_name">{{__('From Name')}}</label>
                  @error('from_name')
                  <small class="red-text errorTxt4">{{__($message)}}</small>
                  @enderror
                </div>
              </div>
              <div class="col s12 display-flex justify-content-end form-action">
                <button type="submit" class="btn indigo waves-effect waves-light mr-2">{{__('Save changes')}}</button>
                <button type="reset" class="btn btn-light-pink waves-effect waves-light ">{{__('Cancel')}}</button>
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
    <script>
       $(document).ready(function(){
        $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
        });
     });
      
    </script>

@endpush
