@extends('layouts.backend.app')

@section('title', __('Edit Person Info'))

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
    
    <form id="person_info" action="{{ route('person-info.update',$person->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
    
    <ul class="stepper demos" >
        <li class="step active">
          <div class="step-title waves-effect">{{__('Step 1')}}</div>
          <div class="step-content">
            <div class="row">
              <div class="input-field col m4 s12">
                <label for="personName">{{__('Name')}}: <span class="red-text">*</span> </label>
                <input type="text" id="personName" name="personName" class="validate @error('personName') is-invalid @enderror" data-error=".errorTxt1" autofocus="personName" value="{{ $person->personName }}">
                @error('personName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m4 s12">
                <label for="surName">{{__('Surname')}}:</label>
                <input type="text" id="surName" name="surName" class="validate @error('surName') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($person->surName)) value="{{$person->surName}}"@endif>
                @error('surName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m4 s12">
                <label for="kuniad">{{__('Kuniad')}}:</label>
                <input type="text" id="kuniad" name="kuniad" class="validate @error('kuniad') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($person->kuniad)) value="{{$person->kuniad}}"@endif>
                @error('kuniad')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="input-field col m6 s12">
                <label for="popularity">{{__('Popularity')}}:</label>
                <input type="text" id="popularity" name="popularity" class="validate @error('popularity') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($person->popularity)) value="{{$person->popularity}}"@endif>
                @error('popularity')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m6 s12">
                <label for="surName">{{__('Surname')}}:</label>
                <input type="text" id="surName" name="surName" class="validate @error('surName') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($person->surName)) value="{{$person->surName}}"@endif>
                @error('surName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="input-field col m3 s12">
                <label for="birthYearHijri">{{__('Birth Year Hijri')}}:</label>
                <input id="birthYearHijri" name="birthYearHijri" type="number" min="1" class="validate mr-2 mb-1 @error('birthYearHijri') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($person->birthYearHijri)) value="{{$person->birthYearHijri}}"@endif>
                @error('birthYearHijri')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <label for="birthYearIsae">{{__('Birth Year Isae')}}:</label>
                <input id="birthYearIsae" name="birthYearIsae" type="number" min="1" class="validate mr-2 mb-1 @error('birthYearIsae') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($person->birthYearIsae)) value="{{$person->birthYearIsae}}"@endif>
                @error('birthYearIsae')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <select class="select2 browser-default validate @error('birthCountry') is-invalid @enderror" id="birthCountry" name="birthCountry">
                  <option value="" disabled selected>{{__('Select Birth Country')}}</option>
                  @foreach ($countries as $country)
                  <option @if (!empty($person->birthPlace))
                    {{ $person->birthPlace->country->id == $country->id ? 'selected':''}}
                  @endif value="{{$country->id}}">{{$country->country}}</option>
                  @endforeach
                </select>
                @error('birthCountry')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
              @enderror
              </div>
              <div class="input-field col m3 s12">
                <select class="select2 browser-default validate @error('birthCity') is-invalid @enderror" id="birthCity" name="birthCity">
                  <option value="" disabled selected >{{__('Select Birth City')}}</option>
                  @if (!empty($person->birthPlace))
                    @foreach ($person->birthPlace->country->cities as $city)
                      <option {{$person->birthPlaceID == $city->id ? 'selected':''}} value="{{$city->id}}">{{$city->city}}</option>
                    @endforeach
                  @endif
                </select>
                @error('birthCity')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
              @enderror
              </div>
            </div>
            <div class="row">
              <div class="input-field col m3 s12">
                <label for="deathYearHijri">{{__('Death Year Hijri')}}:</label>
                <input id="deathYearHijri" name="deathYearHijri" type="number" min="1" class="validate mr-2 mb-1 @error('deathYearHijri') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($person->deathYearHijri)) value="{{$person->deathYearHijri}}"@endif>
                @error('deathYearHijri')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <label for="deathYearIsae">{{__('Death Year Isae')}}:</label>
                <input id="deathYearIsae" name="deathYearIsae" type="number" min="1" class="validate mr-2 mb-1 @error('deathYearIsae') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($person->deathYearIsae)) value="{{$person->deathYearIsae}}"@endif>
                @error('deathYearIsae')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <select class="select2 browser-default validate @error('deathCountry') is-invalid @enderror" id="deathCountry" name="deathCountry">
                  <option value="0" disabled selected>{{__('Select Death Country')}}</option>
                  @foreach ($countries as $country)
                  <option @if (!empty($person->deathPlace))
                    {{ $person->deathPlace->country->id == $country->id ? 'selected':''}}
                  @endif value="{{$country->id}}">{{$country->country}}</option>
                  @endforeach
                </select>
                @error('deathCountry')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <select class="select2 browser-default validate @error('deathCity') is-invalid @enderror" id="deathCity" name="deathCity">
                  <option value="0" disabled selected >{{__('Select Death City')}}</option>
                  @if (!empty($person->deathPlace))
                    @foreach ($person->deathPlace->country->cities as $city)
                      <option {{$person->deathPlaceID == $city->id ? 'selected':''}} value="{{$city->id}}">{{$city->city}}</option>
                    @endforeach
                  @endif
                </select>
                @error('deathCity')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              </div>
              @if (count($person->person_residences) != 0)
              @foreach ($person->person_residences as $key => $residence)
                
              <div id="row_default_residence{{$key}}" class="row">
                <div class="input-field col m3 s12">
                  <label for="reStartYearHijri{{$key}}">{{__('Residence Start Year Hijri')}}:</label>
                  <input id="reStartYearHijri{{$key}}" name="reStartYearHijri[]" type="number" min="1" class="validate @error('reStartYearHijri') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($residence->reStartYearHijri)) value="{{$residence->reStartYearHijri}}"@endif>
                  @error('reStartYearHijri')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="reEndYearHijri{{$key}}">{{__('Residence End Year Hijri')}}:</label>
                  <input id="reEndYearHijri{{$key}}" name="reEndYearHijri[]" type="number" min="1" class="validate @error('reEndYearHijri') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($residence->reEndYearHijri)) value="{{$residence->reEndYearHijri}}"@endif>
                  @error('reEndYearHijri')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="reStartYearIsae{{$key}}">{{__('Residence Start Year Isae')}}:</label>
                  <input id="reStartYearIsae{{$key}}" name="reStartYearIsae[]" type="number" min="1" class="validate @error('reStartYearIsae') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($residence->reStartYearIsae)) value="{{$residence->reStartYearIsae}}"@endif>
                  @error('reStartYearIsae')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="reEndYearIsae{{$key}}">{{__('Residence End Year Isae')}}:</label>
                  <input id="reEndYearIsae{{$key}}" name="reEndYearIsae[]" type="number" min="1" class="validate @error('reEndYearIsae') is-invalid @enderror" data-error=".errorTxt1" @if (!empty($residence->reEndYearIsae)) value="{{$residence->reEndYearIsae}}"@endif>
                  @error('reEndYearIsae')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m5 s12">
                  <select class="select2 browser-default reCountry @error('reCountry') is-invalid @enderror" id="reCountry{{$key}}" name="reCountry[]" >
                    <option value="0" disabled selected>{{__('Select Residence Country')}}</option>
                    @foreach ($countries as $country)
                    <option @if (!empty($residence->residence_place))
                    {{ $residence->residence_place->countryID == $country->id ? 'selected':''}}
                    @endif value="{{$country->id}}">{{$country->country}}</option>
                    @endforeach
                  </select>
                  @error('reCountry')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
                </div>
                <div class="input-field col m5 s12">
                  <select class="select2 browser-default @error('reCity') is-invalid @enderror" id="reCityreCountry{{$key}}" name="reCity[]" >
                    <option value="0" disabled selected >{{__('Select Residence City')}}</option>
                    @if (!empty($residence->residence_place))
                      @foreach ($residence->residence_place->country->cities as $city)
                        <option {{$residence->residencePlaceID == $city->id ? 'selected':''}} value="{{$city->id}}">{{$city->city}}</option>
                      @endforeach
                      @endif
                  </select>
                  @error('reCity')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
                </div>
                <div class="input-field col m1">
                  @if ($key == 0)
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Residence')}}" id="add_residence" type="button"><i class="material-icons">add_circle</i></button>
                  </div>
                  @else
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-amber-amber default_residence_remove tooltipped" data-tooltip="{{__('Colse this Recidence')}}" name="default_residence_remove" id="{{$key}}" type="button"><i class="material-icons">highlight_off</i></button>
                  </div>
                  @endif
                </div>
              </div>
            @endforeach
            @else

            <div class="row">
                <div class="input-field col m3 s12">
                  <label for="reStartYearHijri">{{__('Residence Start Year Hijri')}}:</label>
                  <input id="reStartYearHijri" name="reStartYearHijri[]" type="number" min="1" class="validate @error('reStartYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                  @error('reStartYearHijri')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="reEndYearHijri">{{__('Residence End Year Hijri')}}:</label>
                  <input id="reEndYearHijri" name="reEndYearHijri[]" type="number" min="1" class="validate @error('reEndYearHijri') is-invalid @enderror" data-error=".errorTxt1" >
                  @error('reEndYearHijri')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="reStartYearIsae">{{__('Residence Start Year Isae')}}:</label>
                  <input id="reStartYearIsae" name="reStartYearIsae[]" type="number" min="1" class="validate @error('reStartYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                  @error('reStartYearIsae')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="reEndYearIsae">{{__('Residence End Year Isae')}}:</label>
                  <input id="reEndYearIsae" name="reEndYearIsae[]" type="number" min="1" class="validate @error('reEndYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                  @error('reEndYearIsae')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m5 s12">
                  <select class="select2 browser-default reCountry @error('reCountry') is-invalid @enderror" id="reCountry" name="reCountry[]" >
                    <option value="0" disabled selected>{{__('Select Residence Country')}}</option>
                    @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->country}}</option>
                    @endforeach
                  </select>
                  @error('reCountry')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
                </div>
                <div class="input-field col m5 s12">
                  <select class="select2 browser-default @error('reCity') is-invalid @enderror" id="reCityreCountry" name="reCity[]" >
                    <option value="0" disabled selected >{{__('Select Residence City')}}</option>
                  </select>
                  @error('reCity')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
                </div>
                <div class="input-field col m1">
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Recidence')}}" id="add_residence" type="button"><i class="material-icons">add_circle</i></button>
                  </div>
                </div>
              </div>

            @endif
          <div id="dynamic_residence">
              
          </div>
            <div class="step-actions">
              <div class="row">
                <div class="col m4 s12 mb-3">
                  <button class="red btn btn-reset" type="reset" value="Reset">
                    <i class="material-icons left">clear</i>{{__('Reset')}}
                  </button>
                </div>
                <div class="col m4 s12 mb-3">
                  <button class="btn btn-light previous-step" disabled>
                    <i class="material-icons left">arrow_back</i>
                    {{__('Prev')}}
                  </button>
                </div>
                <div class="col m4 s12 mb-3">
                  <button class="waves-effect waves dark btn btn-primary next-step" type="submit">
                    {{__('Next')}}
                    <i class="material-icons right">arrow_forward</i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="step">
          <div class="step-title waves-effect">{{__('Step 2')}}</div>
          <div class="step-content">
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col m6 s12">
                  <select class="select2 browser-default @error('mazhabFikih') is-invalid @enderror" id="mazhabFikih" name="mazhabFikih">
                    <option value="0" disabled selected>{{__('Select Mazhab (Fikih)')}}</option>
                    @foreach ($mazhabFikih as $mazhab)
                      <option @if (!empty($person->mazhab_fikih))
                        {{$person->mazhab_fikih->id == $mazhab->id ? 'selected':''}}
                      @endif value="{{$mazhab->id}}">{{$mazhab->mazhabName}}</option>
                    @endforeach
                  </select>
                  @error('mazhabFikih')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
                </div>
                <div class="input-field col m6 s12">
                  <select class="select2 browser-default @error('mazhabAkidah') is-invalid @enderror" id="mazhabAkidah" name="mazhabAkidah">
                    <option value="0" disabled selected>{{__('Select Mazhab (Akidah)')}}</option>
                    @foreach ($mazhabAkidah as $mazhab)
                      <option @if (!empty($person->mazhab_akidah))
                        {{$person->mazhab_akidah->id == $mazhab->id ? 'selected':''}}
                      @endif value="{{$mazhab->id}}">{{$mazhab->mazhabName}}</option>
                    @endforeach
                  </select>
                  @error('mazhabAkidah')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
                </div>
              </div>
            </div>
            <div class="col s12 m6">
              <div class="row">
                <div class=" col m10 s12">
              <label class="select-wrapper" for="teacher">{{__('Teacher of His/Her')}}:</label>
                <select class="select2 browser-default @error('teacher') is-invalid @enderror" id="teacher" name="teacher[]" multiple>
                <option value="0" disabled>Select Teachers</option>
                @if (!empty($teachers->persons))
                @foreach ($teachers->persons as $persons)
                @if ($person->id != $persons->id)
                <option @if (!empty($person->person_teachers)) @foreach ($person->person_teachers as $teacher)
                  {{$teacher->id == $persons->id ? 'selected':''}} @endforeach @endif value="{{$persons->id}}">{{$persons->personName}}</option>
                @endif
                @endforeach
                @endif
                </select>
                @error('teacher')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            </div>
            <div class="col s12 m6">
               <div class="row">
                <div class=" col m10 s12">
              <label class="select-wrapper" for="student">{{__('Students of His/Her')}}:</label>
                <select class="select2 browser-default @error('student') is-invalid @enderror" id="student" name="student[]" multiple>
                <option value="0" disabled>Select Students</option>
                @if (!empty($students->persons))
                @foreach ($students->persons as $persons)
                @if ($person->id != $persons->id)
                <option @if (!empty($person->person_students)) @foreach ($person->person_students as $student)
                  {{$student->id == $persons->id ? 'selected':''}} @endforeach @endif value="{{$persons->id}}">{{$persons->personName}}</option>
                @endif
                @endforeach
                @endif
                </select>
                @error('student')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
            </div>
            </div>
            </div>
            <div class="col s12 m12">
              @if (count($person->person_written_books)!=0)
              @foreach ($person->person_written_books as $key => $written_book)
              
              <div id="row_default_written_book{{$key+1}}" class="row">
                <div class="input-field col m10 s12">
                  <label for="writtenBook{{$key+1}}">{{__('Written Book')}}:</label>
                  <input type="text" class="validate @error('writtenBook') is-invalid @enderror" value="{{$written_book->writtenBook}}" id="writtenBook{{$key+1}}" name="writtenBook[]">
                  @error('writtenBook')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m2 s12">
                  @if ($key == 0)
                  <div class="input-field m1">
                      <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Written Book')}}" id="add_written_book" type="button"><i class="material-icons">add_circle</i></button>
                    </div>
                    @else
                    <div class="input-field m1">
                      <button class="btn-floating gradient-45deg-amber-amber default_written_book_remove tooltipped" data-tooltip="{{__('Colse this Written Book')}}" name="default_written_book_remove" id="{{$key+1}}" type="button"><i class="material-icons">highlight_off</i></button>
                    </div>
                    @endif
                </div>
              </div>
              @endforeach
              @else
              <div class="row">
                <div class="input-field col m10 s12">
                  <label for="writtenBook">{{__('Written Book')}}:</label>
                  <input type="text" class="validate @error('writtenBook') is-invalid @enderror" id="writtenBook" name="writtenBook[]">
                  @error('writtenBook')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m2 s12">
                  <div class="input-field m1">
                      <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Written Book')}}" id="add_written_book" type="button"><i class="material-icons">add_circle</i></button>
                    </div>
                </div>
              </div>
              @endif
              <div id="dynamic_written_book">
              
              </div>
          </div>
          
            <div class="row">
            <div class="col m12">
            <div class="step-actions">
              <div class="row">
                <div class="col m4 s12 mb-3">
                  <button class="red btn btn-reset" type="reset">
                    <i class="material-icons left">clear</i>{{__('Reset')}}
                  </button>
                </div>
                <div class="col m4 s12 mb-3">
                  <button class="btn btn-light previous-step">
                    <i class="material-icons left">arrow_back</i>
                    {{__('Prev')}}
                  </button>
                </div>
                <div class="col m4 s12 mb-3">
                  <button class="waves-effect waves dark btn btn-primary next-step" type="submit">
                    {{__('Next')}}
                    <i class="material-icons right">arrow_forward</i>
                  </button>
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
        </li>
        <li class="step">
          <div class="step-title waves-effect">{{__('Step 3')}}</div>
          <div class="step-content">
            <div class="col s12 m6">
            <div class="row">
              <div class=" col m10 s12">
            <label class="select-wrapper" for="inspiredBy">{{__('Inspired By')}}:</label>
              <select class="select2 browser-default @error('inspiredBy') is-invalid @enderror" id="inspiredBy" name="inspiredBy[]" multiple>
                <option value="0" disabled>{{__('Select Person Inspired By')}}</option>
                @if (!empty($teachers->persons))
                @foreach ($teachers->persons as $persons)
                @if ($person->id != $persons->id)
                <option @if (!empty($person->person_mentors)) @foreach ($person->person_mentors as $mentor)
                  {{$mentor->id == $persons->id ? 'selected':''}} @endforeach @endif value="{{$persons->id}}">{{$persons->personName}}</option>
                @endif
                @endforeach
                @endif
              </select>
              @error('inspiredBy')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
            </div>
            </div>
            @if (count($person->person_quotations) != 0)
              @foreach($person->person_quotations as $key=> $quotation)
            
            <div id="row_default_quotation{{$key+2}}" class="row">
              <div class="input-field col m10 s12">
                <label for="quotation{{$key+2}}">{{__('Quotation')}}:</label>
                <textarea name="quotation[]" id="quotation{{$key+2}}" rows="" class="materialize-textarea @error('quotation') is-invalid @enderror">{!! $quotation->quotation !!}</textarea>
                @error('quotation')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m2 s12">
                @if ($key==0)
                <div class="input-field m1">
                  <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Quotation')}}" id="add_quotation" type="button"><i class="material-icons">add_circle</i></button>
                </div>
                @else
                <div class="input-field m1">
                  <button class="btn-floating gradient-45deg-amber-amber default_quotation_remove tooltipped" data-tooltip="{{__('Colse this Quotation')}}" name="default_quotation_remove" id="{{$key+2}}" type="button"><i class="material-icons">highlight_off</i></button>
                </div>
                @endif
              </div>
            </div>
            @endforeach
            @else
            <div class="row">
              <div class="input-field col m10 s12">
                <label for="quotation">{{__('Quotation')}}:</label>
                <textarea name="quotation[]" id="quotation" rows="" class="materialize-textarea @error('quotation') is-invalid @enderror"></textarea>
                @error('quotation')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m2 s12">
                <div class="input-field m1">
                  <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Quotation')}}" id="add_quotation" type="button"><i class="material-icons">add_circle</i></button>
                </div>
              </div>
            </div>
            @endif
            <div id="dynamic_quotation">
              
            </div>
            </div>
            <div class="col s12 m6">
            <div class="row">
              <div class=" col m10 s12">
            <label class="select-wrapper" for="inspiredWhom">{{__('Inspired Whom')}}:</label>
              <select class="select2 browser-default @error('inspiredWhom') is-invalid @enderror" id="inspiredWhom" name="inspiredWhom[]" multiple data-error=".errorTxt1">
                <option value="0" disabled>{{__('Select Person Inspired Whom')}}</option>
                @if (!empty($students->persons))
                @foreach ($students->persons as $persons)
                @if ($person->id != $persons->id)
                <option @if (!empty($person->person_followers)) @foreach ($person->person_followers as $follower)
                  {{$follower->id == $persons->id ? 'selected':''}} @endforeach @endif value="{{$persons->id}}">{{$persons->personName}}</option>
                @endif
                @endforeach
                @endif
              </select>
              @error('inspiredWhom')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
              @enderror
            </div>
            </div>
            <div class="row">
           <div class=" col m10 s12">
            <label class="select-wrapper" for="personCategory">{{__('Person Category')}}:<span class="red-text">*</span></label>
              <select class="select2 browser-default @error('personCategory') is-invalid @enderror" id="personCategory" name="personCategory[]" multiple>
                <option value="0" disabled>{{__('Select Person Cateegory')}}</option>
                @foreach ($personCategories as $person_category)
                <option @if (!empty($person->person_categories)) @foreach ($person->person_categories as $category)
                  {{$category->id == $person_category->id ? 'selected':''}} @endforeach @endif value="{{$person_category->id}}">{{__($person_category->person_category)}}</option>
                @endforeach
              </select>
              @error('personCategory')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
              @enderror
            </div>

          </div>
            </div>
            <div class="row">
             <div class="input-field col m12 s12">
             <label for="description">{{__('Description')}}:</label>
             <textarea name="description" id="description" rows="" class="materialize-textarea @error('description') is-invalid @enderror">@if (!empty($person->description)){{ $person->description }}
             @endif</textarea>
             @error('description')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
              @enderror
           </div>
          </div>
            <div class="step-actions">
              <div class="row">
                <div class="col m3 s12 mb-3">
                  <button class="red btn mr-1 btn-reset" type="reset">
                    <i class="material-icons">clear</i>
                    {{__('Reset')}}
                  </button>
                </div>
                <div class="col m3 s12 mb-3">
                  <button class="btn btn-light previous-step">
                    <i class="material-icons left">arrow_back</i>
                    {{__('Prev')}}
                  </button>
                </div>
                <div class="col m3 s12 mb-3">
                  <button class="waves-effect waves-dark btn indigo" type="submit">{{__('Update')}}</button>
                </div>
                <div class="col m3 s12 mb-3">
                  <a href="{{ route('person-info.index') }}" class="btn purple">{{__('Cancel')}}</a>
                </div>
              </div>
            </div>
          </div>
        </li>
      </ul>
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
    

    <script type="text/javascript">
    $(document).ready(function(){      
     


      $('#add_residence').click(function(){  
        var minm = 20; 
        var maxm = 50; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) { 

        $('#dynamic_residence').append('<div id="row_residence'+i+'"><div class="row"><div class="input-field col m3 s12"><label for="reStartYearHijri'+i+'">{{__('Residence Start Year Hijri')}}:</label><input id="reStartYearHijri'+i+'" name="reStartYearHijri[]" type="number" min="1" class="validate @error('reStartYearHijri') is-invalid @enderror" data-error=".errorTxt1">@error('reStartYearHijri')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><label for="reEndYearHijri'+i+'">{{__('Residence End Year Hijri')}}:</label><input id="reEndYearHijri'+i+'" name="reEndYearHijri[]" type="number" min="1" class="validate @error('reEndYearHijri') is-invalid @enderror" data-error=".errorTxt1">@error('reEndYearHijri')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><label for="reStartYearIsae'+i+'">{{__('Residence Start Year Isae')}}:</label><input id="reStartYearIsae'+i+'" name="reStartYearIsae[]" type="number" min="1" class="validate @error('reStartYearIsae') is-invalid @enderror" data-error=".errorTxt1">@error('reStartYearIsae')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><label for="reEndYearIsae'+i+'">{{__('Residence End Year Isae')}}:</label><input id="reEndYearIsae'+i+'" name="reEndYearIsae[]" type="number" min="1" class="validate @error('reEndYearIsae') is-invalid @enderror" data-error=".errorTxt1">@error('reEndYearIsae')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m5 s12"><select class="select2 browser-default reCountry" id="reCountry'+i+'" name="reCountry[]" ><option value="0" disabled selected>{{__('Select Residence Country')}}</option>@foreach ($countries as $country)<option value="{{$country->id}}">{{$country->country}}</option>@endforeach</select></div><div class="input-field col m5 s12"><select class="select2 browser-default" id="reCityreCountry'+i+'" name="reCity[]" ><option value="0" disabled selected>{{__('Select Residence City')}}</option></select></div><div class="input-field col m1"><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber residence_remove tooltipped" data-tooltip="{{__('Colse this Residence')}}" name="remove_residence" id="'+i+'" type="button"><i class="material-icons">highlight_off</i></button></div></div></div></div>'); 
        $('.tooltipped').tooltip();
        $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

        

    }
      });  

      $(document).on('click', '.residence_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_residence'+button_id+'').remove();  
      });  


      
    });  

  </script>

<script type="text/javascript">
    $(document).ready(function(){      
     
      $('#add_written_book').click(function(){  
        
        var minm = 20; 
        var maxm = 50; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) {  
        $('#dynamic_written_book').append('<div id="row_written_book'+i+'" class="dynamic-added"><div class="row"><div class="input-field col m10 s12"><label for="writtenBook'+i+'">{{__('Written Book')}}:</label><input type="text" class="validate" id="writtenBook'+i+'" name="writtenBook[]"></div><div class="input-field col m2 s12"><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber written_book_remove tooltipped" data-tooltip="{{__('Close this Written Book')}}" id="'+i+'" type="button"><i class="material-icons">highlight_off</i></button></div></div></div></div>');  
        $('.tooltipped').tooltip();
    }
      });  

      $(document).on('click', '.written_book_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_written_book'+button_id+'').remove();  
      });  

      
    });  

</script>



<script type="text/javascript">
    $(document).ready(function(){      
     
      $('#add_quotation').click(function(){  
        
        var minm = 20; 
        var maxm = 50; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) { 
        $('#dynamic_quotation').append('<div id="row_quotation'+i+'" class="dynamic-added"><div class="row"><div class="input-field col m10 s12"><label for="quotation'+i+'">{{__('Quotation')}}:</label><textarea name="quotation[]" id="quotation'+i+'" rows="" class="materialize-textarea"></textarea></div><div class="input-field col m2 s12"><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber quotation_remove tooltipped" data-tooltip="{{__('Close this Quotation')}}" id="'+i+'" type="button"><i class="material-icons">highlight_off</i></button></div></div></div></div>');  
        
            $('.tooltipped').tooltip();
            
    }
      });  

      $(document).on('click', '.quotation_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_quotation'+button_id+'').remove();  
      });  

      
    });  

</script>

<script>
  $(document).on('change', '.reCountry', function(){  
           var id = $(this).attr("id"); 
           let data = $(this).val(); 
           $('#reCity'+id+'').empty();
           $('#reCity'+id+'').append(`<option value="0" disabled > {{__('Processing...')}} </option>`); 
           if($('#'+id+'').val != ''){ 
            $.ajax({
            type: 'GET',
            url: 'getreCityDynamic',
            data: { reCountryDynamic: data },
            success: function (response) {
            var response = JSON.parse(response); 
            $('#reCity'+id+'').empty();
            $('#reCity'+id+'').append(`<option value="0" disabled selected >{{__('Select Residence City')}}</option>`);
            response.forEach(element => {
                $('#reCity'+id+'').append(`<option value="${element['id']}">${element['city']}</option>`);
                });
            }
        });
            }
            else{
                $('#reCity'+id+'').empty();
                $('#reCity'+id+'').append(`<option value="0" disabled selected >{{__('Select Residence City')}}</option>`);
            }
      });

  $(document).ready(function () {
            $('#birthCountry').on('change', function () {
            let id = $(this).val();
            $('#birthCity').empty();
            $('#birthCity').append(`<option value="0" disabled > {{__('Processing...')}} </option>`);
            if($('#birthCountry').val != ''){
            $.ajax({
            type: 'GET',
            url: 'getBirthCity',
            data: { birthCountry: id },
            success: function (response) {
            var response = JSON.parse(response); 
            $('#birthCity').empty();
            $('#birthCity').append(`<option value="0" disabled selected >{{__('Select Birth City')}}</option>`);
            response.forEach(element => {
                $('#birthCity').append(`<option value="${element['id']}">${element['city']}</option>`);
                });
            }
        });
            }
            else{
                $('#birthCity').empty();
                $('#birthCity').append(`<option value="0" disabled selected >{{__('Select Birth City')}}</option>`);
            }
    });

            $('#deathCountry').on('change', function () {
            let id = $(this).val();
            $('#deathCity').empty();
            $('#deathCity').append(`<option value="0" disabled > {{__('Processing...')}} </option>`);
            if($('#deathCountry').val != ''){
            $.ajax({
            type: 'GET',
            url: 'getDeathCity',
            data: { deathCountry: id },
            success: function (response) {
            var response = JSON.parse(response); 
            $('#deathCity').empty();
            $('#deathCity').append(`<option value="0" disabled selected >{{__('Select Death City')}}</option>`);
            response.forEach(element => {
                $('#deathCity').append(`<option value="${element['id']}">${element['city']}</option>`);
                });
            }
        });
            }
            else{
                $('#deathCity').empty();
                $('#deathCity').append(`<option value="0" disabled selected >{{__('Select Death City')}}</option>`);
            }
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click', '.default_residence_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_default_residence'+button_id+'').remove();  
      });

    $(document).on('click', '.default_written_book_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_default_written_book'+button_id+'').remove();  
      });

    $(document).on('click', '.default_quotation_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_default_quotation'+button_id+'').remove();  
      });
  });
</script>


<script src="{{asset('assets/backend/app-assets/js/scripts/form-select2.min.js')}}"></script>
<script src="{{asset('assets/backend/stepper/js/mstepper.js')}}"></script>

    

@endpush
