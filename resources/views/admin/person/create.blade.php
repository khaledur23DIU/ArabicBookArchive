@extends('layouts.backend.app')

@section('title', __('Create New Person Info'))

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
   
    <form id="person_info" action="{{ route('person-info.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
    
    <ul class="stepper demos" >
        <li class="step active">
          <div class="step-title waves-effect">{{__('Step 1')}}</div>
          <div class="step-content">
            <div class="row">
              <div class="input-field col m4 s12">
                <label for="personName">{{__('Name')}}: <span class="red-text">*</span> </label>
                <input type="text" id="personName" name="personName" class="validate @error('personName') is-invalid @enderror" data-error=".errorTxt1" autofocus="personName" value="{{ old('personName')}}" required>
                @error('personName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m4 s12">
                <label for="surName">{{__('Surname')}}:</label>
                <input type="text" id="surName" name="surName" class="validate @error('surName') is-invalid @enderror" data-error=".errorTxt1">
                @error('surName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m4 s12">
                <label for="kuniad">{{__('Kuniad')}}:</label>
                <input type="text" id="kuniad" name="kuniad" class="validate @error('kuniad') is-invalid @enderror" data-error=".errorTxt1">
                @error('kuniad')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="input-field col m6 s12">
                <label for="popularity">{{__('Popularity')}}:</label>
                <input type="text" id="popularity" name="popularity" class="validate @error('popularity') is-invalid @enderror" data-error=".errorTxt1" value="{{ old('popularity')}}" required>
                @error('popularity')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m6 s12">
                <label for="fathersName">{{__('Fathers Name')}}:</label>
                <input type="text" id="fathersName" name="fathersName" class="validate @error('fathersName') is-invalid @enderror" data-error=".errorTxt1">
                @error('fathersName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="input-field col m3 s12">
                <label for="birthYearHijri">{{__('Birth Year Hijri')}}:</label>
                <input id="birthYearHijri" name="birthYearHijri" type="number" min="1" class="validate mr-2 mb-1 @error('birthYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                @error('birthYearHijri')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <label for="birthYearIsae">{{__('Birth Year Isae')}}:</label>
                <input id="birthYearIsae" name="birthYearIsae" type="number" min="1" class="validate mr-2 mb-1 @error('birthYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                @error('birthYearIsae')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <select class="select2 browser-default validate" id="birthCountry" name="birthCountry">
                  <option value="" disabled selected>{{__('Select Birth Country')}}</option>
                  @foreach ($countries as $country)
                  <option value="{{$country->id}}">{{$country->country}}</option>
                  @endforeach
                </select>
              </div>
              <div class="input-field col m3 s12">
                <select class="select2 browser-default validate @error('birthCity') is-invalid @enderror" id="birthCity" name="birthCity">
                  <option value="" disabled selected >{{__('Select Birth City')}}</option>
                </select>
                @error('birthCity')
                <small class="red-text errorTxt1">{{__($message)}}</small>
                @enderror
              </div>
            </div>
            <div class="row">
              <div class="input-field col m3 s12">
                <label for="deathYearHijri">{{__('Death Year Hijri')}}:</label>
                <input id="deathYearHijri" name="deathYearHijri" type="number" min="1" class="validate mr-2 mb-1 @error('deathYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                @error('deathYearHijri')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <label for="deathYearIsae">{{__('Death Year Isae')}}:</label>
                <input id="deathYearIsae" name="deathYearIsae" type="number" min="1" class="validate mr-2 mb-1 @error('deathYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                @error('deathYearIsae')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <select class="select2 browser-default validate @error('deathCountry') is-invalid @enderror" id="deathCountry" name="deathCountry">
                  <option value="0" disabled selected>{{__('Select Death Country')}}</option>
                  @foreach ($countries as $country)
                  <option value="{{$country->id}}">{{$country->country}}</option>
                  @endforeach
                </select>
                @error('deathCountry')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <select class="select2 browser-default validate @error('deathCity') is-invalid @enderror" id="deathCity" name="deathCity">
                  <option value="0" disabled selected >{{__('Select Death City')}}</option>
                </select>
                @error('deathCity')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              </div>
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
                  <input id="reEndYearHijri" name="reEndYearHijri[]" type="number" min="1" class="validate @error('reEndYearHijri') is-invalid @enderror" data-error=".errorTxt1">
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
                    <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Residence')}}" id="add_residence" type="button"><i class="material-icons">add_circle</i></button>
                  </div>
                </div>
              </div>
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
                      <option value="{{$mazhab->id}}">{{$mazhab->mazhabName}}</option>
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
                      <option value="{{$mazhab->id}}">{{$mazhab->mazhabName}}</option>
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
                <option value="0" disabled>{{__('Select Teachers')}}</option>
                @if (!empty($teachers->persons))
                @foreach ($teachers->persons as $person)
                <option value="{{$person->id}}">{{$person->personName}}</option>
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
              <label class="select-wrapper" for="student">{{__('Students of His/Her')}}</label>
                <select class="select2 browser-default @error('student') is-invalid @enderror" id="student" name="student[]" multiple>
                <option value="0" disabled>{{__('Select Students')}}</option>
                @if (!empty($students->persons))
                @foreach ($students->persons as $person)
                <option value="{{$person->id}}">{{$person->personName}}</option>
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
              <div class="row">
                <div class="input-field col m10 s12">
                  <label for="writtenBook">{{__('Written Book')}}:</label>
                  <input type="text" class="validate" id="writtenBook" name="writtenBook[]">
                </div>
                <div class="input-field col m2 s12">
                  <div class="input-field m1">
                      <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Written Book')}}" id="add_written_book" type="button"><i class="material-icons">add_circle</i></button>
                    </div>
                </div>
              </div>
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
                @foreach ($teachers->persons as $person)
                <option value="{{$person->id}}">{{$person->personName}}</option>
                @endforeach
                @endif
              </select>
              @error('inspiredBy')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
            </div>
            </div>
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
                @foreach ($students->persons as $person)
                <option value="{{$person->id}}">{{$person->personName}}</option>
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
                @foreach ($personCategories as $category)
                <option value="{{$category->id}}">{{__($category->person_category)}}</option>
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
             <textarea name="description" id="description" rows="" class="materialize-textarea @error('description') is-invalid @enderror"></textarea>
             @error('description')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
              @enderror
           </div>
          </div>
            <div class="step-actions">
              <div class="row">
                <div class="col m4 s12 mb-1">
                  <button class="red btn mr-1 btn-reset" type="reset">
                    <i class="material-icons">clear</i>
                    {{__('Reset')}}
                  </button>
                </div>
                <div class="col m4 s12 mb-3">
                  <button class="btn btn-light previous-step">
                    <i class="material-icons left">arrow_back</i>
                    {{__('Prev')}}
                  </button>
                </div>
                <div class="col m4 s12 mb-1">
                  <button class="waves-effect waves-dark btn btn-primary" type="submit">{{__('Submit')}}</button>
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
        var minm = 1; 
        var maxm = 20; 
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
        
        var minm = 1; 
        var maxm = 20; 
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
        
        var minm = 1; 
        var maxm = 20; 
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


<script src="{{asset('assets/backend/app-assets/js/scripts/form-select2.min.js')}}"></script>
<script src="{{asset('assets/backend/stepper/js/mstepper.js')}}"></script>

    

@endpush
