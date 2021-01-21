@extends('layouts.backend.app')

@section('title', __('Create New Published Book Info'))

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
    
  	<form action="{{ route('publishedBookInfo.store') }}" method="POST" enctype="multipart/form-data">
  		@csrf
    <div class="card-content">
  	
  	<ul class="stepper demos" >
        <li class="step active">
          <div class="step-title waves-effect">{{__('Step 1')}}</div>
          <div class="step-content">
          	<div class="row">
              <div class="select-wraper col m6 s12">
              	<label for="author">{{__('Publisher')}}: <span class="red-text">*</span> </label>
                <select class="select2 browser-default author validate @error('author') is-invalid @enderror" id="author" name="author" autofocus="author" required data-error=".errorTxt1">
                  <option value="0" disabled selected>{{__('Select One')}}</option>
                  @foreach ($authors->persons as $person)
                  <option value="{{$person->id}}">{{$person->personName}}</option>
                  @endforeach
                </select>
                @error('author')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="select-wraper col m6 s12">
              	<label for="bookBasicInfo">{{__('Book')}}: <span class="red-text">*</span> </label>
                <select class="select2 browser-default validate @error('bookBasicInfo') is-invalid @enderror" id="bookBasicInfo" name="bookBasicInfo" required data-error=".errorTxt1">
                  <option value="0" disabled selected>{{__('Select Book')}}</option>
                  @foreach ($bookBasicInfos as $bookBasicInfo)
                    <option value="{{$bookBasicInfo->id}}">{{$bookBasicInfo->book->bookName}}</option>
                  @endforeach
                </select>
                @error('bookBasicInfo')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>

            	<strong><p class="purple-text">{{__('Edition Info')}}</p></strong>
            <div class="row">
            	<div class="input-field col m4 s12">
	                <label for="editionNo">{{__('Edition No')}}:</label>
	                <input type="text" id="editionNo" name="editionNo[]" class="validate @error('editionNo') is-invalid @enderror" data-error=".errorTxt1">
	                @error('editionNo')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	             </div>
	            <div class="input-field col m4 s12">
	                <label for="editionYearHijri">{{__('Edition Year Hijri')}}:</label>
	                <input id="editionYearHijri" name="editionYearHijri[]" type="number" min="1" class="validate @error('editionYearHijri') is-invalid @enderror" data-error=".errorTxt1">
	                @error('editionYearHijri')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
                </div>
                <div class="input-field col m4 s12">
	                <label for="editionYearIsae">{{__('Edition Year Isae')}}:</label>
	                <input id="editionYearIsae" name="editionYearIsae[]" type="number" min="1" class="validate @error('editionYearIsae') is-invalid @enderror" data-error=".errorTxt1">
	                @error('editionYearIsae')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
              	</div>
              	
            </div>
            <div class="row">
            	<div class="input-field col m2 s12">
	                <label for="partCount">{{__('Part Count')}}:</label>
	                <input type="number" min="1" id="partCount" name="partCount[]" class="validate @error('partCount') is-invalid @enderror" data-error=".errorTxt1">
	                @error('partCount')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m2 s12">
	                <label for="pageCount">{{__('Page Count')}}:</label>
	                <input type="number" min="1" id="pageCount" name="pageCount[]" class="validate @error('pageCount') is-invalid @enderror" data-error=".errorTxt1">
	                @error('pageCount')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m2 s12">
	                <label for="pageSize">{{__('Page Size')}}:</label>
	                <input type="number" min="1" id="pageSize" name="pageSize[]" class="validate @error('pageSize') is-invalid @enderror" data-error=".errorTxt1">
	                @error('pageSize')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
              <div class="input-field col m3 s12">
                  <label for="coverPhotoLink">{{__('Cover Photo Link')}}:</label>
                  <input type="url" id="coverPhotoLink" name="coverPhotoLink[]" class="validate @error('coverPhotoLink') is-invalid @enderror" data-error=".errorTxt1">
                  @error('coverPhotoLink')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
	            <div class="input-field col m3 s12">
	                <label for="pdfLink">{{__('PDF Link')}}:</label>
	                <input type="url" id="pdfLink" name="pdfLink[]" class="validate @error('pdfLink') is-invalid @enderror" data-error=".errorTxt1">
	                @error('pdfLink')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
            </div>
            <div class="row">
            	<div class="input-field col m12 s12">
                <label for="errors">{{__('Errors')}}:</label>
                <textarea name="errors[]" id="errors" rows="" class="materialize-textarea @error('errors') is-invalid @enderror"></textarea>
                @error('errors')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              	</div>
            </div>
            <div class="row">
            	<div class="input-field col m11 s12">
                <label for="description">{{__('Description')}}:</label>
                <textarea name="description[]" id="description" rows="" class="materialize-textarea @error('description') is-invalid @enderror"></textarea>
                @error('description')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              </div>
              <div class="input-field col m1">
                <div class="input-field m1">
                  <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Edition')}}" id="add_edition" type="button"><i class="material-icons">add_circle</i></button>
                </div>
              </div>
            </div>
          	<div id="dynamic_edition">
          		
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
    		</div>
          </div>
        </li>
        
        <li class="step">
          <div class="step-title waves-effect">{{__('Step 2')}}</div>
          <div class="step-content">
          	<strong><p class="purple-text">{{__('Editor Info')}}</p></strong>
	        <div class="row">
	           <div class="select-wraper col m6 s12">
                <label for="editor">{{__('Editor')}}: <span class="red-text">*</span> </label>
                <select class="select2 browser-default editor validate @error('editor') is-invalid @enderror" id="editor" name="editor[]" autofocus="editor" required data-error=".errorTxt1">
                  <option value="0" disabled selected>{{__('Select Editor')}}</option>
                  @foreach ($editors->persons as $person)
                  <option value="{{$person->id}}">{{$person->personName}}</option>
                  @endforeach
                </select>
                @error('editor')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
            </div>
            <div class="input-field col m6 s12">
             <label for="workCategory">{{__('Work Category')}}:</label>
                  <input type="text" class="validate" id="workCategory" name="workCategory[]">
           </div>
         </div>
         <div class="row">
		       <div class="input-field col m11 s12">
              <label for="editorDescription">{{__('Description')}}:</label>
              <textarea name="editorDescription[]" id="editorDescription" rows="" class="materialize-textarea @error('editorDescription') is-invalid @enderror"></textarea>
              @error('editorDescription')
              <small class="red-text errorTxt1">{{ __($message) }}</small>
              @enderror
            </div>
		       <div class="input-field col m1">
                <div class="input-field m1">
                  <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Editor')}}" id="add_editor" type="button"><i class="material-icons">add_circle</i></button>
                </div>
	           </div>
	        </div>

	        <div id="dynamic_editor"></div>
	        
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
  </div>
	</form>
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
       
      $('#add_edition').click(function(){  
        var minm = 1; 
        var maxm = 20; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) { 

        $('#dynamic_edition').append('<div id="row_edition'+i+'"><div class="row"><div class="input-field col m4 s12"><label for="editionNo'+i+'">{{__('Edition No')}}:</label><input type="text" id="editionNo'+i+'" name="editionNo[]" class="validate @error('editionNo') is-invalid @enderror" data-error=".errorTxt1">@error('editionNo')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m4 s12"><label for="editionYearHijri'+i+'">{{__('Edition Year Hijri')}}:</label><input id="editionYearHijri'+i+'" name="editionYearHijri[]" type="number" min="1" class="validate @error('editionYearHijri') is-invalid @enderror" data-error=".errorTxt1">@error('editionYearHijri')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m4 s12"><label for="editionYearIsae'+i+'">{{__('Edition Year Isae')}}:</label><input id="editionYearIsae'+i+'" name="editionYearIsae[]" type="number" min="1" class="validate @error('editionYearIsae') is-invalid @enderror" data-error=".errorTxt1">@error('editionYearIsae')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="row"><div class="input-field col m2 s12"><label for="partCount'+i+'">{{__('Part Count')}}:</label><input type="number" min="1" id="partCount'+i+'" name="partCount[]" class="validate @error('partCount') is-invalid @enderror" data-error=".errorTxt1">@error('partCount')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m2 s12"><label for="pageCount'+i+'">{{__('Page Count')}}:</label><input type="number" min="1" id="pageCount'+i+'" name="pageCount[]" class="validate @error('pageCount') is-invalid @enderror" data-error=".errorTxt1">@error('pageCount')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m2 s12"><label for="pageSize'+i+'">{{__('Page Size')}}:</label><input type="number" min="1" id="pageSize'+i+'" name="pageSize[]" class="validate @error('pageSize') is-invalid @enderror" data-error=".errorTxt1">@error('pageSize')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><label for="coverPhotoLink'+i+'">{{__('Cover Photo Link')}}:</label><input type="url" id="coverPhotoLink'+i+'" name="coverPhotoLink[]" class="validate @error('coverPhotoLink') is-invalid @enderror" data-error=".errorTxt1">@error('coverPhotoLink')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><label for="pdfLink'+i+'">{{__('PDF Link')}}:</label><input type="url" id="pdfLink'+i+'" name="pdfLink[]" class="validate @error('pdfLink') is-invalid @enderror" data-error=".errorTxt1">@error('pdfLink')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div></div><div class="row"><div class="input-field col m12 s12"><label for="errors'+i+'">{{__('Errors')}}:</label><textarea name="errors[]" id="errors'+i+'" rows="" class="materialize-textarea"></textarea></div></div><div class="row"><div class="input-field col m11 s12"><label for="description'+i+'">{{__('Description')}}:</label><textarea name="description[]" id="description'+i+'" rows="" class="materialize-textarea"></textarea></div><div class="input-field col m1"><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber remove_edition tooltipped" data-tooltip="{{__('Colse this Edition')}}" id="'+i+'" type="button"><i class="material-icons">highlight_off</i></button></div></div></div></div>'); 
        $('.tooltipped').tooltip();
        $(".select2").select2({
		    dropdownAutoWidth: true,
		    width: '100%'
		});

        /*$(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "YYYY",
                hijriFormat:"iYYYY",
                dayViewHeaderFormat: "YYYY",
                hijriDayViewHeaderFormat: "iYYYY",
                showSwitcher: false,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode:'years',
                keepOpen: false,
                hijri: true,
                debug: false,
                showClear: false,
                showTodayButton: false,
                showClose: false
            });
        $(".isae").hijriDatePicker({
                locale: "ar-sa",
                format: "YYYY",
                hijriFormat:"iYYYY",
                dayViewHeaderFormat: "YYYY",
                hijriDayViewHeaderFormat: "iYYYY",
                showSwitcher: false,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode:'years',
                keepOpen: false,
                hijri: false,
                debug: false,
                showClear: false,
                showTodayButton: false,
                showClose: false
            }); */
    }
      });  

      $(document).on('click', '.remove_edition', function(){  
           var button_id = $(this).attr("id");   
           $('#row_edition'+button_id+'').remove();  
      });  


      
    });  

	</script>

<script type="text/javascript">
    $(document).ready(function(){      
     
      $('#add_editor').click(function(){  
        
        var minm = 1; 
        var maxm = 20; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) {  
        $('#dynamic_editor').append('<div id="row_editor'+i+'" class="dynamic-added"><div class="row"><div class="select-wraper col m6 s12"><label for="editor'+i+'">{{__('Editor')}}: <span class="red-text">*</span> </label><select class="select2 browser-default validate @error('editor') is-invalid @enderror" id="editor'+i+'" name="editor[]"  required data-error=".errorTxt1"><option value="0" disabled selected>{{__('Select Editor')}}</option>@foreach ($editors->persons as $person)<option value="{{$person->id}}">{{$person->personName}}</option>@endforeach</select>@error('editor')<small class="red-text errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m6 s12"><label for="workCategory'+i+'">{{__('Work Category')}}:</label><input type="text" class="validate" id="workCategory'+i+'" name="workCategory[]"></div></div><div class="row"><div class="input-field col m11 s12"><label for="editorDescription'+i+'">{{__('Description')}}:</label><textarea name="editorDescription[]" id="editorDescription'+i+'" rows="" class="materialize-textarea"></textarea></div><div class="input-field col m1"><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber remove_editor tooltipped" data-tooltip="{{__('Close this Editor')}}" id="'+i+'" type="button"><i class="material-icons">highlight_off</i></button></div></div></div></div>');  
        $('.tooltipped').tooltip();
        $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
    }
      });  

      $(document).on('click', '.remove_editor', function(){  
           var button_id = $(this).attr("id");   
           $('#row_editor'+button_id+'').remove();  
      });  

      
    });  

</script>


<script src="{{asset('assets/backend/app-assets/js/scripts/form-select2.min.js')}}"></script>
<script src="{{asset('assets/backend/stepper/js/mstepper.js')}}"></script>

    

@endpush
