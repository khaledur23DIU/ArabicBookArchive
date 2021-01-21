@extends('layouts.backend.app')

@section('title', __('Edit Publisher'))

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
    <div class="card-content s8">
    <form action="{{ route('publicationInfo.update',$publisher->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
          <div class="card-content">
            <div class="row">
              <div class="input-field col m6 s10">
                <label for="publicationName">{{__('Name of the Publication')}}: <span class="red-text">*</span> </label>
                <input type="text" id="publicationName" value="{{$publisher->publicationName}}" name="publicationName" class="validate @error('publicationName') is-invalid @enderror" data-error=".errorTxt1" required>
                @error('publicationName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="select-wraper col m6 s10">
                <label for="ownerID">{{__('Owner')}}: <span class="red-text">*</span> </label>
                <select class="select2 browser-default validate @error('ownerID') is-invalid @enderror" id="ownerID" name="ownerID" autofocus="ownerID" required="true">
                  <option value="0" disabled selected>{{__('Select Owner')}}</option>
                  @if (!empty($publishers->persons))
                  @foreach ($publishers->persons as $person)
                  <option {{$publisher->ownerID== $person->id ?'selected': ''}} value="{{$person->id}}">{{$person->personName}}</option>
                  @endforeach
                  @endif
                </select>
                @error('ownerID')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="select-wraper col m6 s10">
                <label for="country">{{__('Country')}}:</label>
                <select class="select2 browser-default @error('country') is-invalid @enderror" id="country" name="country">
                  <option value="0" disabled selected>{{__('Select Country')}}</option>
                  @foreach ($countries as $country)
                  <option 
                    @if (!empty($publisher->place))
                       {{$publisher->place->country->id == $country->id ? 'selected':''}}
                     @endif value="{{$country->id}}">{{$country->country}}</option>
                  @endforeach
                </select>
                @error('country')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="select-wraper col m6 s10">
                <label for="city">{{__('City')}}:</label>
                <select class="select2 browser-default @error('city') is-invalid @enderror" id="city" name="city">
                  <option value="0" disabled selected >{{__('Select City')}}</option>
                  @foreach ($publisher->place->country->cities as $city)
                    <option {{$city->id == $publisher->placeID ? 'selected':'' }} value="{{$city->id}}">{{$city->city}}</option>
                  @endforeach
                </select>
                @error('city')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="input-field col m6 s10">
                  <label for="stablishedYearHijri">{{__('Established Year Hijri')}}:</label>
                  <input id="stablishedYearHijri" value="{{$publisher->stablishedYearHijri }}" name="stablishedYearHijri" type="number" min="1" class="validate @error('stablishedYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                  @error('stablishedYearHijri')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              <div class="input-field col m6 s10">
                  <label for="stablishedYearIsae">{{__('Established Year Isae')}}:</label>
                  <input id="stablishedYearIsae" value="{{$publisher->stablishedYearIsae }}" name="stablishedYearIsae" type="number" min="1" class="validate isae @error('stablishedYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                  @error('stablishedYearIsae')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
          </div>
                <div class="row">
              <div class="input-field col m6 s10">
                  <label for="website">{{__('Website')}}:</label>
                  <input type="url" id="website" value="{{$publisher->web }}" name="website" class="validate @error('website') is-invalid @enderror" data-error=".errorTxt1">
                  @error('website')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              <div class="input-field col m6 s10">
                  <label for="email">{{__('Email')}}:</label>
                  <input type="email" id="email" value="{{$publisher->email }}" name="email" class="validate @error('email') is-invalid @enderror" data-error=".errorTxt1">
                  @error('email')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              </div>

              <div class="row">
              <div class="input-field col m6 s10">
                  <label for="phone">{{__('Phone')}}:</label>
                  <input type="text" id="phone" value="{{$publisher->phone }}" name="phone" class="validate @error('phone') is-invalid @enderror" data-error=".errorTxt1">
                  @error('phone')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              <div class="input-field col m6 s10">
                  <label for="mobile">{{__('Mobile')}}:</label>
                  <input type="text" id="mobile" value="{{$publisher->mobile }}" name="mobile" class="validate @error('mobile') is-invalid @enderror" data-error=".errorTxt1">
                  @error('mobile')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              </div>

              <div class="row">
              <div class="input-field col m6 s10">
                  <label for="facebook">{{__('Facebook')}}:</label>
                  <input type="url" id="facebook" value="{{$publisher->facebook }}" name="facebook" class="validate @error('facebook') is-invalid @enderror" data-error=".errorTxt1">
                  @error('facebook')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              <div class="input-field col m6 s10">
                  <label for="instagram">{{__('Instagram')}}:</label>
                  <input type="url" id="instagram" value="{{$publisher->instagram }}" name="instagram" class="validate @error('instagram') is-invalid @enderror" data-error=".errorTxt1">
                  @error('instagram')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              </div>

              <div class="row">
              <div class="input-field col m6 s10">
                  <label for="twitter">{{__('Twitter')}}:</label>
                  <input type="url" id="twitter" value="{{$publisher->twitter }}" name="twitter" class="validate @error('twitter') is-invalid @enderror" data-error=".errorTxt1">
                  @error('twitter')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              <div class="input-field col m6 s10">
                  <label for="linkedIn">{{__('LinkedIn')}}:</label>
                  <input type="url" id="linkedIn" value="{{$publisher->linkedIn }}" name="linkedIn" class="validate @error('linkedIn') is-invalid @enderror" data-error=".errorTxt1">
                  @error('linkedIn')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              </div>

              <div class="row">
              <div class="input-field col m6 s10">
                  <label for="youtube">{{__('Youtube')}}:</label>
                  <input type="url" id="youtube" value="{{$publisher->youtube }}" name="youtube" class="validate @error('youtube') is-invalid @enderror" data-error=".errorTxt1">
                  @error('youtube')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              <div class="input-field col m6 s10">
                  <label for="gMap">{{__('Google Map')}}:</label>
                  <input type="text" id="gMap" value="{{$publisher->locationMapLink }}" name="gMap" class="validate @error('gMap') is-invalid @enderror" data-error=".errorTxt1">
                  @error('gMap')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              </div>
            
            <div class="step-actions">
              <div class="row">
                <div class="col s12 display-flex justify-content-end mt-3">
                <button type="submit" class="btn indigo">{{ __('Update') }}</button>
                <a href="{{ route('publicationInfo.index') }}" class="btn btn-light">{{ __('Cancel') }}</a>
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
    $(document).ready(function () {
            $('#country').on('change', function () {
            let id = $(this).val();
            $('#city').empty();
            $('#city').append(`<option value="0" disabled > {{__('Processing...')}} </option>`);
            if($('#country').val != ''){
            $.ajax({
            type: 'GET',
            url: 'getPublicationcityUpdate',
            data: { country: id },
            success: function (response) {
            var response = JSON.parse(response); 
            $('#city').empty();
            $('#city').append(`<option value="0" disabled selected >{{__('Select City')}}</option>`);
            response.forEach(element => {
                $('#city').append(`<option value="${element['id']}">${element['city']}</option>`);
                });
            }
        });
            }
            else{
                $('#city').empty();
                $('#city').append(`<option value="0" disabled selected >{{__('Select City')}}</option>`);
            }
    });
        });
  </script>



<script src="{{asset('assets/backend/app-assets/js/scripts/form-select2.min.js')}}"></script>
<script src="{{asset('assets/backend/stepper/js/mstepper.js')}}"></script>

    

@endpush
