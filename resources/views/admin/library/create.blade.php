@extends('layouts.backend.app')

@section('title', __('Create Library'))

@push('css')
	
	<link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/form-select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2-materialize.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/materialize-stepper/materialize-stepper.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/form-wizard.min.css')}}">

@endpush

@section('content')
<div class="card">
    <div class="card-content">
    
  	<hr>
  	<form action="{{ route('libraryList.store') }}" method="POST" enctype="multipart/form-data">
  		@csrf
  		
          <div class="card-content">

          	<div class="row">
              <div class="input-field col m4 s10">
                <label for="libraryName">{{__('Library Name')}}: <span class="red-text">*</span> </label>
                <input type="text" id="libraryName" name="libraryName" class="validate @error('libraryName') is-invalid @enderror" data-error=".errorTxt1" required autofocus="libraryName">
                @error('libraryName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m4 s10">
                <select class="select2 browser-default @error('country') is-invalid @enderror" id="country" name="country">
                  <option value="0" disabled selected>{{__('Select Country')}}</option>
                  @foreach ($countries as $country)
                  <option value="{{$country->id}}">{{$country->country}}</option>
                  @endforeach
                </select>
                @error('country')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m4 s10">
                <select class="select2 browser-default @error('city') is-invalid @enderror" id="city" name="city">
                  <option value="0" disabled selected >{{__('Select City')}}</option>
                </select>
                @error('city')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            <div class="row">
            	<div class="input-field col m6 s10">
	                <label for="stablishedYearHijri">{{__('Stablished Year Hijri')}}:</label>
	                <input id="stablishedYearHijri" name="stablishedYearHijri" type="number" min="1" class="validate @error('stablishedYearHijri') is-invalid @enderror" data-error=".errorTxt1">
	                @error('stablishedYearHijri')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m6 s10">
	                <label for="stablishedYearIsae">{{__('Stablished Year Isae')}}:</label>
	                <input id="stablishedYearIsae" name="stablishedYearIsae" type="number" min="1" class="validate @error('stablishedYearIsae') is-invalid @enderror" data-error=".errorTxt1">
	                @error('stablishedYearIsae')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	        </div>
               	<div class="row">
            	<div class="input-field col m6 s10">
	                <label for="website">{{__('Website')}}:</label>
	                <input type="url" id="website" name="website" class="validate @error('website') is-invalid @enderror" data-error=".errorTxt1">
	                @error('website')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m6 s10">
	                <label for="email">{{__('Email')}}:</label>
	                <input type="email" id="email" name="email" class="validate @error('email') is-invalid @enderror" data-error=".errorTxt1">
	                @error('email')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
            	</div>

            	<div class="row">
            	<div class="input-field col m6 s10">
	                <label for="phone">{{__('Phone')}}:</label>
	                <input type="text" id="phone" name="phone" class="validate @error('phone') is-invalid @enderror" data-error=".errorTxt1">
	                @error('phone')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m6 s10">
	                <label for="mobile">{{__('Mobile')}}:</label>
	                <input type="text" id="mobile" name="mobile" class="validate @error('mobile') is-invalid @enderror" data-error=".errorTxt1">
	                @error('mobile')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
            	</div>

            	<div class="row">
            	<div class="input-field col m6 s10">
	                <label for="facebook">{{__('Facebook')}}:</label>
	                <input type="url" id="facebook" name="facebook" class="validate @error('facebook') is-invalid @enderror" data-error=".errorTxt1">
	                @error('facebook')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m6 s10">
	                <label for="instagram">{{__('Instagram')}}:</label>
	                <input type="url" id="instagram" name="instagram" class="validate @error('instagram') is-invalid @enderror" data-error=".errorTxt1">
	                @error('instagram')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
            	</div>

            	<div class="row">
            	<div class="input-field col m6 s10">
	                <label for="twitter">{{__('Twitter')}}:</label>
	                <input type="url" id="twitter" name="twitter" class="validate @error('twitter') is-invalid @enderror" data-error=".errorTxt1">
	                @error('twitter')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m6 s10">
	                <label for="linkedIn">{{__('LinkedIn')}}:</label>
	                <input type="url" id="linkedIn" name="linkedIn" class="validate @error('linkedIn') is-invalid @enderror" data-error=".errorTxt1">
	                @error('linkedIn')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
            	</div>

            	<div class="row">
            	<div class="input-field col m6 s10">
	                <label for="youtube">{{__('Youtube')}}:</label>
	                <input type="url" id="youtube" name="youtube" class="validate @error('youtube') is-invalid @enderror" data-error=".errorTxt1">
	                @error('youtube')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m6 s10">
	                <label for="gMap">{{__('Google Map')}}:</label>
	                <input type="text" id="gMap" name="gMap" class="validate @error('gMap') is-invalid @enderror" data-error=".errorTxt1">
	                @error('gMap')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
            	</div>
            
            <div class="step-actions">
              <div class="row">
                <div class="col s12 display-flex justify-content-end mt-2">
                <button type="submit" class="btn indigo">
                  {{ __('Save') }}</button>
                <a href="{{ route('dashboard') }}" class="btn btn-light">{{ __('Cancel') }}</a>
              </div>
              </div>
            </div>
          </div>
        
	</form>
  </div>
  </div>

				 
@endsection

@push('js')
	<script src="{{asset('assets/backend/app-assets/vendors/select2/select2.full.min.js')}}"></script>
	<script src="{{asset('assets/backend/app-assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
  	<script src="{{asset('assets/backend/app-assets/js/scripts/page-users.min.js')}}"></script>
  	<script src="{{asset('assets/backend/app-assets/vendors/materialize-stepper/materialize-stepper.min.js')}}"></script>
	
	<script>

	   var domSteppers = document.querySelectorAll('.stepper.demos');
	   for (var i = 0, len = domSteppers.length; i < len; i++) {
	      var domStepper = domSteppers[i];
	      new MStepper(domStepper);
	   }

	</script>
  	


	<script>
		$(document).ready(function () {
            $('#country').on('change', function () {
            let id = $(this).val();
            $('#city').empty();
            $('#city').append(`<option value="0" disabled > {{__('Processing...')}} </option>`);
            if($('#country').val != ''){
            $.ajax({
            type: 'GET',
            url: 'getLibraryCity',
            data: { country: id },
            success: function (response) {
            var response = JSON.parse(response); 
            $('#city').empty();
            $('#city').append(`<option value="0" disabled selected > {{__('Select City')}} </option>`);
            response.forEach(element => {
                $('#city').append(`<option value="${element['id']}">${element['city']}</option>`);
                });
            }
        });
            }
            else{
                $('#city').empty();
                $('#city').append(`<option value="0" disabled selected > {{__('Select City')}} </option>`);
            }
    });
        });
	</script>



<script src="{{asset('assets/backend/app-assets/js/scripts/form-select2.min.js')}}"></script>
<script src="{{asset('assets/backend/stepper/js/mstepper.js')}}"></script>

    

@endpush
