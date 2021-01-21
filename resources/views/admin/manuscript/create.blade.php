@extends('layouts.backend.app')

@section('title', __('Create New Manuscript Info'))

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
    
  	<form action="{{ route('manuscriptInfo.store') }}" method="POST" enctype="multipart/form-data">
  		@csrf
  	
  	<ul class="stepper demos" >
        <li class="step active">
          <div class="step-title waves-effect">{{__('Step 1')}}</div>
          <div class="step-content">
          	<div class="row">
              <div class="select-wraper col m4 s12">
              	<label for="author">{{__('Author')}}: <span class="red-text">*</span> </label>
                <select class="select2 browser-default validate author @error('author') is-invalid @enderror" id="author" name="author" autofocus="author" required data-error=".errorTxt1">
                  <option value="0" disabled selected>{{__('Select Author')}}</option>
                  @foreach ($authors->persons as $person)
                  <option value="{{$person->id}}">{{$person->personName}}</option>
                  @endforeach
                </select>
                @error('author')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="select-wraper col m4 s12">
              	<label for="book">{{__('Book')}}: <span class="red-text">*</span> </label>
                <select class="select2 browser-default validate @error('book') is-invalid @enderror" id="bookauthor" name="book" required data-error=".errorTxt1">
                  <option value="0" disabled selected>{{__('Select Book')}}</option>
                </select>
                @error('book')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="iselect-wraper col m4 s12">
              	<label for="library">{{__('Library')}}: <span class="red-text">*</span> </label>
                <select class="select2 browser-default validate @error('library') is-invalid @enderror" id="library" name="library" autofocus="library" required data-error=".errorTxt1">
                  <option value="0" disabled selected>{{__('Select Library')}}</option>
                  @foreach ($libraryList as $library)
                  <option value="{{$library->id}}">{{$library->libraryName}}</option>
                  @endforeach
                </select>
                @error('library')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>

               <div class="row">
            	<div class="input-field col m6 s12">
	                <label for="indexInLibrary">{{__('Index In Library')}}:</label>
	                <input type="text" id="indexInLibrary" name="indexInLibrary" class="validate @error('indexInLibrary') is-invalid @enderror" data-error=".errorTxt1">
	                @error('indexInLibrary')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	             </div>
	             <div class="select-wraper col m6 s12">
	              	<label for="writer">{{__('Writers')}}: <span class="red-text">*</span> </label>
	                <select class="select2 browser-default validate @error('writer') is-invalid @enderror" id="writer" name="writer[]" autofocus="writer" required data-error=".errorTxt1" required multiple>
	                  <option value="0" disabled>{{__('Select Writers')}}</option>
	                  @foreach ($writers->persons as $writer)
	                  <option value="{{$writer->id}}">{{$writer->personName}}</option>
	                  @endforeach
	                </select>
	                @error('writer')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
              </div>
            </div>
            <div class="row">
            	<div class="input-field col m6 s12">
	                <label for="writtenYearHijri">{{__('Written Year Hijri')}}:</label>
	                <input id="writtenYearHijri" name="writtenYearHijri" type="number" min="1" class="validate @error('writtenYearHijri') is-invalid @enderror" data-error=".errorTxt1">
	                @error('writtenYearHijri')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	              </div>
	              
	              <div class="input-field col m6 s12">
	                <label for="writtenYearIsae">{{__('Written Year Isae')}}:</label>
	                <input id="writtenYearIsae" name="writtenYearIsae" type="number" min="1" class="validate @error('writtenYearIsae') is-invalid @enderror" data-error=".errorTxt1">
	                @error('writtenYearIsae')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	              </div>
	              
            </div>
            <div class="row">
            	<div class="input-field col m4 s12">
	                <label for="pageCount">{{__('Part Count')}}:</label>
	                <input type="number" min="1" id="pageCount" name="pageCount" class="validate @error('pageCount') is-invalid @enderror" data-error=".errorTxt1">
	                @error('pageCount')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m4 s12">
	                <label for="pageSize">{{__('Page Size')}}:</label>
	                <input type="number" min="1" id="pageSize" name="pageSize" class="validate @error('pageSize') is-invalid @enderror" data-error=".errorTxt1">
	                @error('pageSize')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
	            </div>
	            <div class="input-field col m4 s12">
	                <label for="lineCountPerPage">{{__('Line Count Per-page')}}:</label>
	                <input type="number" min="1" id="lineCountPerPage" name="lineCountPerPage" class="validate @error('lineCountPerPage') is-invalid @enderror" data-error=".errorTxt1">
	                @error('lineCountPerPage')
	                <small class="red-text errorTxt1">{{ __($message) }}</small>
	                @enderror
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
	        
	        <div class="row">
            	<div class="input-field col m12 s12">
                <label for="startingLine">{{__('Starting Line')}}:</label>
                <textarea name="startingLine" id="startingLine" rows="" class="materialize-textarea @error('startingLine') is-invalid @enderror"></textarea>
                @error('startingLine')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              	</div>
            </div>
            <div class="row">
            	<div class="input-field col m12 s12">
                <label for="endingLine">{{__('Ending Line')}}:</label>
                <textarea name="endingLine" id="endingLine" rows="" class="materialize-textarea @error('endingLine') is-invalid @enderror"></textarea>
                @error('endingLine')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
              	</div>
            </div>
            <div class="row">
            	<div class="input-field col m12 s12">
                <label for="errors">{{__('Errors')}}:</label>
                <textarea name="errors" id="errors" rows="" class="materialize-textarea @error('errors') is-invalid @enderror"></textarea>
                @error('errors')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
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
            <div class="row">
            	<div class="input-field col m12 s12">
                <label for="pdfLink">{{__('Pdf Link')}}:</label>
                <input type="url" id="pdfLink" name="pdfLink" class="validate @error('pdfLink') is-invalid @enderror" data-error=".errorTxt1">
                @error('pdfLink')
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
   $(document).on('change', '.author', function(){  
           var id = $(this).attr("id"); 
           let data = $(this).val(); 
           $('#book'+id+'').empty();
           $('#book'+id+'').append(`<option value="0" disabled > {{__('Processing...')}} </option>`); 
           if($('#'+id+'').val != ''){ 
            $.ajax({
            type: 'GET',
            url: 'getbookDynamic',
            data: { bookDynamic: data },
            success: function (response) {
            var response = JSON.parse(response); 
            $('#book'+id+'').empty();
            $('#book'+id+'').append(`<option value="0" disabled selected >{{__('Select Book')}} </option>`);
            response.forEach(element => {
                $('#book'+id+'').append(`<option value="${element['id']}">${element['bookName']}</option>`);
                });
            }
        });
            }
            else{
                $('#book'+id+'').empty();
                $('#book'+id+'').append(`<option value="0" disabled selected >{{__('Select Book')}} </option>`);
            }
      }); 
  </script>
	<script>

	   var domSteppers = document.querySelectorAll('.stepper.demos');
	   for (var i = 0, len = domSteppers.length; i < len; i++) {
	      var domStepper = domSteppers[i];
	      new MStepper(domStepper);
	   }

	</script>
  	

<script src="{{asset('assets/backend/app-assets/js/scripts/form-select2.min.js')}}"></script>
<script src="{{asset('assets/backend/stepper/js/mstepper.js')}}"></script>

    

@endpush
