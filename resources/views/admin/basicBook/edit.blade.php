@extends('layouts.backend.app')

@section('title', __('Edit Book Basic Info'))

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
    
    <form action="{{ route('bookBasicInfo.update',$bookBasicInfo->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
    
    <ul class="stepper demos" >
        <li class="step active">
          <div class="step-title waves-effect">{{__('Step 1')}}</div>
          <div class="step-content">
            <div class="row">
              <div class="select-wraper col m4 s12">
                <label for="author">{{__('Author')}}: <span class="red-text">*</span></label>
                <select class="select2 browser-default @error('author') is-invalid @enderror" id="author" name="author" required>
                  <option disabled selected>{{__('Select Author')}}</option>
                  @if (!empty($authors->persons))
                  @foreach ($authors->persons as $person)
                  <option @if (!empty($bookBasicInfo->book->person_book->person_list_bookable))
                   {{$bookBasicInfo->book->person_book->person_list_bookable->id == $person->id ? 'selected':''}} @endif value="{{$person->id}}">{{$person->personName}}</option>
                  @endforeach
                  @endif
                </select>
                @error('author')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m4 s12">
                <label for="bookName">{{__('Book Name')}}: <span class="red-text">*</span> </label>
                <input type="text" id="bookName" @if (!empty($bookBasicInfo->book))
                   value="{{$bookBasicInfo->book->bookName}}" @endif name="bookName" class="validate @error('bookName') is-invalid @enderror" data-error=".errorTxt1" required>
                @error('bookName')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="select-wraper col m4 s12">
                <label for="bookCategory">{{__('Book Categories')}}: <span class="red-text">*</span></label>
                <select class="select2 browser-default @error('bookCategory') is-invalid @enderror" id="bookCategory" name="bookCategory[]" multiple required>
                  <option value="0" disabled>{{__('Select Book Category')}}</option>
                  @foreach ($bookCategories as $cat)
                  <option @if (!empty($bookBasicInfo->book->book_categories))
                    @foreach ($bookBasicInfo->book->book_categories as $category)
                   {{$category->id == $cat->id ? 'selected':''}} @endforeach @endif value="{{$cat->id}}">{{$cat->bookCategory}}</option>
                  @endforeach
                </select>
                @error('bookCategory')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            
            <div class="row">
            <div class="input-field col m3 s12">
                <label for="startYearHijri">{{__('Start Year Hijri')}}:</label>
                <input id="startYearHijri" @if (!empty($bookBasicInfo->startYearHijri)) value="{{$bookBasicInfo->startYearHijri}}"@endif name="startYearHijri" type="number" min="1" class="validate @error('startYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                @error('startYearHijri')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <label for="endYearHijri">{{__('End Year Hijri')}}:</label>
                <input id="endYearHijri" @if (!empty($bookBasicInfo->endYearHijri)) value="{{$bookBasicInfo->endYearHijri}}"@endif name="endYearHijri" type="number" min="1" class="validate @error('endYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                @error('endYearHijri')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <label for="startYearIsae">{{__('Start Year Isae')}}:</label>
                <input id="startYearIsae" @if (!empty($bookBasicInfo->startYearIsae)) value="{{$bookBasicInfo->startYearIsae}}"@endif name="startYearIsae" type="number" min="1" class="validate @error('startYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                @error('startYearIsae')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m3 s12">
                <label for="endYearIsae">{{__('End Year Isae')}}:</label>
                <input id="endYearIsae" @if (!empty($bookBasicInfo->endYearIsae)) value="{{$bookBasicInfo->endYearIsae}}"@endif name="endYearIsae" type="number" min="1" class="validate @error('endYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                @error('endYearIsae')
                <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
            <strong><p class="purple-text">{{__('Place of Writing')}}</p></strong>
            @if (count($bookBasicInfo->book_basic_writing_places)!=0)
              @foreach ($bookBasicInfo->book_basic_writing_places as $key => $writing_place)
                
              <div id="row_default_writing_place{{$key}}" class="row">
                <div class="input-field col m3 s12">
                  <label for="writingStartYearHijri{{$key}}">{{__('Writing Start Year Hijri')}}:</label>
                  <input id="writingStartYearHijri{{$key}}" @if (!empty($writing_place->writingStartYearHijri))
                    value="{{$writing_place->writingStartYearHijri}}"
                  @endif name="writingStartYearHijri[]" type="number" min="1" class="validate @error('writingStartYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                  @error('writingStartYearHijri')
                  <small class="errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="writingEndYearHijri{{$key}}">{{__('Writing End Year Hijri')}}:</label>
                  <input id="writingEndYearHijri{{$key}}" @if (!empty($writing_place->writingEndYearHijri))
                    value="{{$writing_place->writingEndYearHijri}}"
                  @endif name="writingEndYearHijri[]" type="number" min="1" class="validate @error('writingEndYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                  @error('writingEndYearHijri')
                  <small class="errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="writingStartYearIsae{{$key}}">{{__('Writing Start Year Isae')}}:</label>
                  <input id="writingStartYearIsae{{$key}}" @if (!empty($writing_place->writingStartYearIsae))
                    value="{{$writing_place->writingStartYearIsae}}"
                  @endif name="writingStartYearIsae[]" type="number" min="1" class="validate @error('writingStartYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                  @error('writingStartYearIsae')
                  <small class="errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="writingEndYearIsae{{$key}}">{{__('Writing End Year Isae')}}:</label>
                  <input id="writingEndYearIsae{{$key}}" @if (!empty($writing_place->writingEndYearIsae))
                    value="{{$writing_place->writingEndYearIsae}}"
                  @endif name="writingEndYearIsae[]" type="number" min="1" class="validate @error('writingEndYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                  @error('writingEndYearIsae')
                  <small class="errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m5 s12">
                  <select class="select2 browser-default writingCountry @error('writingCountry') is-invalid @enderror" id="writingCountry{{$key}}" name="writingCountry[]" >
                    <option value="0" disabled selected>{{__('Select Writing Place Country')}}</option>
                    @foreach ($countries as $country)
                    <option @if (!empty($writing_place->writing_place))
                    {{ $writing_place->writing_place->country->id == $country->id ? 'selected':''}}
                    @endif value="{{$country->id}}">{{$country->country}}</option>
                    @endforeach
                  </select>
                  @error('writingCountry')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m5 s12">
                  <select class="select2 browser-default @error('writingCity') is-invalid @enderror" id="writingCitywritingCountry{{$key}}" name="writingCity[]" >
                    <option value="0" disabled selected >{{__('Select Writing Place City')}}</option>
                    @if (!empty($writing_place->writing_place))
                      @foreach ($writing_place->writing_place->country->cities as $city)
                        <option {{$writing_place->writingPlaceID == $city->id ? 'selected':''}} value="{{$city->id}}">{{$city->city}}</option>
                      @endforeach
                      @endif
                  </select>
                  @error('writingCity')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m1">
                  @if ($key == 0)
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Writing Place')}}" id="add_writingPlace" type="button"><i class="material-icons">add_circle</i></button>
                  </div>
                  @else
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-amber-amber default_writing_place_remove tooltipped" data-tooltip="{{__('Colse this Writing Place')}}" name="default_writing_place_remove" id="{{$key}}" type="button"><i class="material-icons">highlight_off</i></button>
                  </div>
                  @endif
                </div>
              </div>
              @endforeach
              @else
              <div class="row">
                <div class="input-field col m3 s12">
                  <label for="writingStartYearHijri">{{__('Writing Start Year Hijri')}}:</label>
                  <input id="writingStartYearHijri" name="writingStartYearHijri[]" type="number" min="1" class="validate @error('writingStartYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                  @error('writingStartYearHijri')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="writingEndYearHijri">{{__('Writing End Year Hijri')}}:</label>
                  <input id="writingEndYearHijri" name="writingEndYearHijri[]" type="number" min="1" class="validate @error('writingEndYearHijri') is-invalid @enderror" data-error=".errorTxt1">
                  @error('writingEndYearHijri')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="writingStartYearIsae">{{__('Writing Start Year Isae')}}:</label>
                  <input id="writingStartYearIsae" name="writingStartYearIsae[]" type="number" min="1" class="validate @error('writingStartYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                  @error('writingStartYearIsae')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <label for="writingEndYearIsae">{{__('Writing End Year Isae')}}:</label>
                  <input id="writingEndYearIsae" name="writingEndYearIsae[]" type="number" min="1" class="validate @error('writingEndYearIsae') is-invalid @enderror" data-error=".errorTxt1">
                  @error('writingEndYearIsae')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m5 s12">
                  <select class="select2 browser-default writingCountry @error('writingCountry') is-invalid @enderror" id="writingCountry" name="writingCountry[]" >
                    <option value="0" disabled selected>{{__('Select Writing Place Country')}}</option>
                    @foreach ($countries as $country)
                    <option value="{{$country->id}}">{{$country->country}}</option>
                    @endforeach
                  </select>
                  @error('writingCountry')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m5 s12">
                  <select class="select2 browser-default @error('writingCity') is-invalid @enderror" id="writingCitywritingCountry" name="writingCity[]" >
                    <option value="0" disabled selected >{{__('Select Writing Place City')}}</option>
                  </select>
                  @error('writingCity')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m1">
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Writing Place')}}" id="add_writingPlace" type="button"><i class="material-icons">add_circle</i></button>
                  </div>
                </div>
              </div>
              @endif
          <div id="dynamic_writingsPlace">
              
          </div>
            
            <div class="col s12 m3">
            <div class="row">
              <div class="input-field col m12 s12">
                <select class="select2 browser-default @error('language') is-invalid @enderror" id="language" name="language">
                  <option value="0" disabled selected>{{__('Select Language')}}</option>
                  @foreach ($languages as $lang)
                  <option @if (!empty($bookBasicInfo->languageID))
                    {{$bookBasicInfo->languageID == $lang->id ? 'selected':''}}
                  @endif value="{{$lang->id}}">{{$lang->language}}</option>
                  @endforeach
                </select>
                @error('language')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
            </div>
          </div>
            <div class="col s12 m9">

              @if (count($bookBasicInfo->book_basic_refs)!=0)
              @foreach ($bookBasicInfo->book_basic_refs as $key => $ref)
                  
            <div id="row_default_reference{{$key+1}}" class="row">
              <div class="input-field col m11 s12">
                <label for="reference{{$key}}">{{__('Reference')}}:</label>
                <textarea name="reference[]" id="reference{{$key+1}}" rows="" class="materialize-textarea @error('reference') is-invalid @enderror">{!! $ref->ref !!}</textarea>
                @error('reference')
                <small class="red-text errorTxt1">{{__($message)}}</small>
                @enderror
              </div>
              <div class="input-field col m1">
                @if ($key == 0)
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Reference')}}" id="add_reference" type="button"><i class="material-icons">add_circle</i></button>
                  </div>
                  @else
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-amber-amber default_reference_remove tooltipped" data-tooltip="{{__('Colse this Reference')}}" name="default_reference_remove" id="{{$key+1}}" type="button"><i class="material-icons">highlight_off</i></button>
                  </div>
                @endif
              </div>
            </div>
            @endforeach
            @else
            <div class="row">
              <div class="input-field col m11 s12">
                <label for="reference">{{__('Reference')}}:</label>
                <textarea name="reference[]" id="reference" rows="" class="materialize-textarea @error('reference') is-invalid @enderror"></textarea>
                @error('reference')
                <small class="red-text errorTxt1">{{__($message)}}</small>
                @enderror
              </div>
              <div class="input-field col m1">
                <div class="input-field m1">
                  <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Reference')}}" id="add_reference" type="button"><i class="material-icons">add_circle</i></button>
                </div>
              </div>
            </div>

            @endif
            <div id="dynamic_reference"></div>
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
            @if(count($bookBasicInfo->book_basic_reviwes)!=0)
            @foreach($bookBasicInfo->book_basic_reviwes as $key => $review)
            <div id="row_default_reviwed_book{{$key}}" class="col s12 m12">
              <div class="row">
              <div class="input-field col m4 s12">
                  <select class="select2 browser-default @error('reviewedBook') is-invalid @enderror" id="reviewedBook{{$key}}" name="reviewedBook[]" >
                    <option value="0" disabled selected>{{__('Select Reviewed Book')}}</option>
                    @foreach ($basicBooks as $book)
                    @if ($bookBasicInfo->bookID != $book->id)
                    <option {{$review->reviewBookID == $book->id ? 'selected':''}} value="{{$book->id}}">{{$book->bookName}}</option>
                    @endif
                    @endforeach
                  </select>
                  @error('reviewedBook')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                
              <div class="input-field col m7 s12">
                <label for="review{{$key}}">{{__('Review')}}:</label>
                <textarea name="review[]" id="review{{$key}}" rows="" class="materialize-textarea @error('review') is-invalid @enderror">@if (!empty($review->review))
                  {!! $review->review !!}@endif</textarea>
                @error('review')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m1 s12">
                
                @if ($key == 0)
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Reviewed Book')}}" id="add_reviwedBook" type="button"><i class="material-icons">add_circle</i></button>
                  </div>
                  @else
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-amber-amber default_reviwed_book_remove tooltipped" data-tooltip="{{__('Colse this Reviewed Book')}}" name="default_reviwed_book_remove" id="{{$key}}" type="button"><i class="material-icons">highlight_off</i></button>
                  </div>
                @endif
              </div>
            </div>
            </div>
            @endforeach
            @else
            <div class="col s12 m12">
              <div class="row">
              <div class="input-field col m4 s12">
                  <select class="select2 browser-default @error('reviewedBook') is-invalid @enderror" id="reviewedBook" name="reviewedBook[]" >
                    <option value="0" disabled selected>{{__('Select Reviewed Book')}}</option>
                    @foreach ($basicBooks as $book)
                    @if ($bookBasicInfo->bookID != $book->id)
                    <option value="{{$book->id}}">{{$book->bookName}}</option>
                    @endif
                    @endforeach
                  </select>
                  @error('reviewedBook')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                
              <div class="input-field col m7 s12">
                <label for="review">Review:</label>
                <textarea name="review[]" id="review" rows="" class="materialize-textarea @error('review') is-invalid @enderror"></textarea>
                @error('review')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                @enderror
              </div>
              <div class="input-field col m1 s12">
                <div class="input-field m1">
                  <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Reviewed Book')}}" id="add_reviwedBook" type="button"><i class="material-icons">add_circle</i></button>
                </div>
              </div>
            </div>
            </div>
            @endif
            <div id="dynamic_reviwedBook"></div>
            
            @if(count($bookBasicInfo->book_basic_connected_books)!=0)
            @foreach ($bookBasicInfo->book_basic_connected_books as $key => $related)
            <div id="row_default_related_book{{$key}}" class="col s12 m12">
              <div class="row">
                <div class="input-field col m3 s12">
                <select class="select2 browser-default reBookCat @error('bookCategoryRelID') is-invalid @enderror" id="reBookCat{{$key}}" name="bookCategoryRelID[]">
                  <option value="0" disabled selected>{{__('Select Related Book Category')}}</option>
                  @foreach ($bookCategories as $cat)
                  <option {{$related->connectedBookCategoryID == $cat->id ?'selected':''}} value="{{$cat->id}}">{{$cat->bookCategory}}</option>
                  @endforeach
                </select>
                  @error('bookCategoryRelID')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <select class="select2 browser-default @error('relatedBook') is-invalid @enderror" id="relatedBookreBookCat{{$key}}" name="relatedBook[]" >
                    <option value="0" disabled selected>{{__('Select Related Book')}}</option>
                    @foreach ($basicBooks as $book)
                    <option {{$related->connectedBookID == $book->id ?'selected':''}} value="{{$book->id}}">{{$book->bookName}}</option>
                    @endforeach
                  </select>
                  @error('relatedBook')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                
                <div class="select-wraper col m2 s12">
                  <label for="up{{$key}}">{{__('Up')}}:</label>
                <select class="select2 browser-default up @error('up') is-invalid @enderror" id="up{{$key}}" name="up[]" >
                  <option value="0" disabled selected>{{__('Up')}}</option>
                  <option {{$related->positionUp == 0 ?'selected':''}} value="yes">{{__('Yes')}}</option>
                  <option {{$related->positionUp == 1 ?'selected':''}} value="no">{{__('No')}}</option>
                </select>
                  @error('up')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="select-wraper col m2 s12">
                  <label for="down{{$key}}">{{__('Down')}}:</label>
                <select disabled class="select2 browser-default" id="downup{{$key}}" name="down[]" >
                  <option disabled selected>{{__('Down')}}</option>
                  <option {{$related->positionUp == 0 ?'selected':''}} >{{__('No')}}</option>
                  <option {{$related->positionUp == 1 ?'selected':''}} >{{__('Yes')}}</option>
                </select>
                </div>
                
                @if ($key == 0)
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-cyan-light-green tooltipped" data-tooltip="{{__('Add More Related Book')}}" id="add_relatedBook" type="button"><i class="material-icons">add_circle</i></button>
                  </div>
                  @else
                  <div class="input-field m1">
                    <button class="btn-floating gradient-45deg-amber-amber default_related_book_remove tooltipped"  data-tooltip="{{__('Colse this Related Book')}}" name="default_related_book_remove" id="{{$key}}" type="button"><i class="material-icons">highlight_off</i></button>
                  </div>
                @endif
            </div>
            </div>
            @endforeach
            @else
            <div class="col s12 m12">
              <div class="row">
                <div class="input-field col m3 s12">
                <select class="select2 browser-default reBookCat @error('bookCategoryRelID') is-invalid @enderror" id="reBookCat" name="bookCategoryRelID[]">
                  <option value="0" disabled selected>{{__('Select Related Book Category')}}</option>
                  @foreach ($bookCategories as $cat)
                  <option value="{{$cat->id}}">{{$cat->bookCategory}}</option>
                  @endforeach
                </select>
                  @error('bookCategoryRelID')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="input-field col m3 s12">
                  <select class="select2 browser-default @error('relatedBook') is-invalid @enderror" id="relatedBookreBookCat" name="relatedBook[]" >
                    <option value="0" disabled selected>{{__('Select Related Book')}}</option>
                    @foreach ($basicBooks as $country)
                    <option value="{{$country->id}}">{{$country->bookName}}</option>
                    @endforeach
                  </select>
                  @error('relatedBook')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                
                <div class="select-wraper col m2 s12">
                  <label for="up">{{__('Up')}}:</label>
                <select class="select2 browser-default up @error('up') is-invalid @enderror" id="up" name="up[]" >
                  <option value="0" disabled selected>{{__('Up')}}</option>
                  <option value="yes">{{__('Yes')}}</option>
                  <option value="no">{{__('No')}}</option>
                </select>
                  @error('up')
                  <small class="red-text errorTxt1">{{ __($message) }}</small>
                  @enderror
                </div>
                <div class="select-wraper col m2 s12">
                  <label for="down">{{__('Down')}}:</label>
                <select disabled class="select2 browser-default" id="downup" name="down[]" >
                  <option disabled selected>{{__('Down')}}</option>
                </select>
                </div>
                <div class="input-field m1">
                  <button class="btn-floating gradient-45deg-cyan-light-green tooltipped"  data-tooltip="{{__('Add More Related Book')}}" id="add_relatedBook" type="button"><i class="material-icons">add_circle</i></button>
                </div>
            </div>
          </div>
            @endif
          
          <div id="dynamic_relatedBook"></div>
          
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
            <div class="row">
             <div class="input-field col m12 s12">
             <label for="quotation">{{__('Quotation')}}:</label>
             <textarea name="quotation" id="quotation" rows="" class="materialize-textarea @error('quotation') is-invalid @enderror">@if (!empty($bookBasicInfo->book_basic_quotation))
               {!! $bookBasicInfo->book_basic_quotation->quotation !!}
             @endif</textarea>
             @error('quotation')
              <small class="red-text errorTxt1">{{ __($message) }}</small>
             @enderror
           </div>
          </div>
          <div class="row">
             <div class="input-field col m6 s12">
             <label for="serialNo">{{__('Index Serial No')}}:</label>
                  <input type="text" class="validate @error('serialNo') is-invalid @enderror" @if (!empty($bookBasicInfo->book_basic_index))
               value="{{ $bookBasicInfo->book_basic_index->SLNo }}"
             @endif id="serialNo" name="serialNo">
            @error('serialNo')
              <small class="red-text errorTxt1">{{ __($message) }}</small>
             @enderror
           </div>
           <div class="input-field col m6 s12">
             <label for="indexTitle">{{__('Index Title')}}:</label>
             <textarea name="indexTitle" id="indexTitle" rows="" class="materialize-textarea @error('indexTitle') is-invalid @enderror">@if (!empty($bookBasicInfo->book_basic_index))
               {!! $bookBasicInfo->book_basic_index->indexText !!}
             @endif</textarea>
             @error('indexTitle')
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
                  <a href="{{ route('bookBasicInfo.index') }}" class="btn purple">{{__('Cancel')}}</a>
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
    

      $('#add_writingPlace').click(function(){  
        var minm = 20; 
        var maxm = 50; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) { 

        $('#dynamic_writingsPlace').append('<div id="row_writings'+i+'"><div class="input-field col m3 s12"><label for="writingStartYearHijri'+i+'">{{__('Writing Start Year Hijri')}}:</label><input id="writingStartYearHijri'+i+'" name="writingStartYearHijri[]" type="number" min="1" class="validate @error('writingStartYearHijri') is-invalid @enderror" data-error=".errorTxt1">@error('writingStartYearHijri')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><label for="writingEndYearHijri'+i+'">{{__('Writing End Year Hijri')}}:</label><input id="writingEndYearHijri'+i+'" name="writingEndYearHijri[]" type="number" min="1" class="validate @error('writingEndYearHijri') is-invalid @enderror" data-error=".errorTxt1">@error('writingEndYearHijri')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><label for="writingStartYearIsae'+i+'">{{__('Writing Start Year Isae')}}:</label><input id="writingStartYearIsae'+i+'" name="writingStartYearIsae[]" type="number" min="1" class="validate @error('writingStartYearIsae') is-invalid @enderror" data-error=".errorTxt1">@error('writingStartYearIsae')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><label for="writingEndYearIsae'+i+'">{{__('Writing End Year Isae')}}:</label><input id="writingEndYearIsae'+i+'" name="writingEndYearIsae[]" type="number" min="1" class="validate @error('writingEndYearIsae') is-invalid @enderror" data-error=".errorTxt1">@error('writingEndYearIsae')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="row"><div class="input-field col m5 s12"><select class="select2 browser-default writingCountry" id="writingCountry'+i+'" name="writingCountry[]" ><option value="0" disabled selected>{{__('Select Writing Place Country')}}</option>@foreach ($countries as $country)<option value="{{$country->id}}">{{$country->country}}</option>@endforeach</select></div><div class="input-field col m5 s12"><select class="select2 browser-default" id="writingCitywritingCountry'+i+'" name="writingCity[]" ><option value="0" disabled selected>{{__('Select Writing Place City')}}</option></select></div><div class="input-field col m1"><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber writings_remove tooltipped" name="remove_writing" id="'+i+'" type="button" data-tooltip="{{__('Colse this Writing Place')}}"><i class="material-icons">highlight_off</i></button></div></div></div></div>'); 

        $('.tooltipped').tooltip();
        $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });

            
    }
      });  

      $(document).on('click', '.writings_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_writings'+button_id+'').remove();  
      });  


      
    });  

  </script>

<script type="text/javascript">
    $(document).ready(function(){      
     
      $('#add_reference').click(function(){  
        
        var minm = 20; 
        var maxm = 50; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) {  
        $('#dynamic_reference').append('<div id="row_reference'+i+'" class="dynamic-added"><div class="row"><div class="input-field col m11"><label for="reference'+i+'">{{__('Reference')}}:</label><textarea name="reference[]" id="reference'+i+'" rows="" class="materialize-textarea"></textarea></div><div class="input-field col m1 s12"><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber reference_remove tooltipped" id="'+i+'" type="button" data-tooltip="{{__('Colse this Reference')}}"><i class="material-icons">highlight_off</i></button></div></div></div></div>');  
        $('.tooltipped').tooltip();
    }
      });  

      $(document).on('click', '.reference_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_reference'+button_id+'').remove();  
      });  

      
    });  

</script>

<script type="text/javascript">
    $(document).ready(function(){      
     
      $('#add_reviwedBook').click(function(){  
        
        var minm = 20; 
        var maxm = 50; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) {  
        $('#dynamic_reviwedBook').append('<div id="row_reviwedBook'+i+'" class="dynamic-added"><div class="col s12 m12"><div class="row"><div class="input-field col m4 s12"><select class="select2 browser-default @error('reviewedBook') is-invalid @enderror" id="reviewedBook'+i+'" name="reviewedBook[]" ><option value="0" disabled selected>{{__('Select Reviewed Book')}}</option>@foreach ($basicBooks as $country)<option value="{{$country->id}}">{{$country->bookName}}</option>@endforeach</select>@error('reviewedBook')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m7 s12"><label for="review'+i+'">{{__('Review')}}:</label><textarea name="review[]" id="review'+i+'" rows="" class="materialize-textarea"></textarea></div><div class="input-field col m1 s12"><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber written_book_remove remove_reviwedBook tooltipped" id="'+i+'" type="button" data-tooltip="{{__('Colse this Reviewed Book')}}"><i class="material-icons">highlight_off</i></button></div></div></div></div></div>');
        $('.tooltipped').tooltip();
        $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
    }
      });  

      $(document).on('click', '.remove_reviwedBook', function(){  
           var button_id = $(this).attr("id");   
           $('#row_reviwedBook'+button_id+'').remove();  
      });  

      
    });  

</script>

<script type="text/javascript">
    $(document).ready(function(){      
     
      $('#add_relatedBook').click(function(){  
        
        var minm = 1; 
        var maxm = 20; 
        var loop = Math.floor(Math.random() * (maxm - minm + 1)) + minm;;
        for (i=loop; i < loop+1; i++) {  
        $('#dynamic_relatedBook').append('<div id="row_relatedBook'+i+'" class="dynamic-added"><div class="col s12 m12"><div class="row"><div class="input-field col m3 s12"><select class="select2 browser-default reBookCat @error('reBookCat') is-invalid @enderror" id="reBookCat'+i+'" name="bookCategoryRelID[]" ><option value="0" disabled selected>{{__('Select Related Book Category')}}</option>@foreach ($bookCategories as $cat)<option value="{{$cat->id}}">{{$cat->bookCategory}}</option>@endforeach</select>@error('bookCategoryRelID')<small class="red-text errorTxt1">{{ __($message) }}</small>@enderror</div><div class="input-field col m3 s12"><select class="select2 browser-default @error('relatedBook') is-invalid @enderror" id="relatedBookreBookCat'+i+'" name="relatedBook[]" ><option value="0" disabled selected>{{__('Select Related Book')}}</option></select>@error('relatedBook')<small class="errorTxt1">{{ __($message) }}</small>@enderror</div><div class="select-wraper col m2 s12"><label for="up'+i+'">Up:</label><select class="select2 browser-default up" id="up'+i+'" name="up[]" ><option value="0" disabled selected>{{__('Up')}}</option><option value="yes">{{__('Yes')}}</option><option value="no">{{__('No')}}</option></select>@error('up')<small class="red-text errorTxt1">{{ __($message) }}</small>@enderror</div><div class="select-wraper col m2 s12"><label for="downup'+i+'">Down:</label><select disabled class="select2 browser-default" id="downup'+i+'" name="down[]" ><option disabled selected>{{__('Down')}}</option></select></div><div class="input-field m1"><button class="btn-floating gradient-45deg-amber-amber remove_relatedBook tooltipped" id="'+i+'"  type="button" data-tooltip="{{__('Colse Related Book')}}"><i class="material-icons">highlight_off</i></button></div></div></div></div></div>');  
      $('.tooltipped').tooltip();
      $(".select2").select2({
        dropdownAutoWidth: true,
        width: '100%'
    });
    }
      });  

      $(document).on('click', '.remove_relatedBook', function(){  
           var button_id = $(this).attr("id");   
           $('#row_relatedBook'+button_id+'').remove();  
      });  

      
    });  

</script>

<script type="text/javascript">
    $(document).on('change', '.up', function(){  
           var id = $(this).attr("id"); 
           let no = 'no';
           let yes = 'yes';
           let data = $(this).val(); 
           if(data == yes){
            $('#down'+id+'').append(`<option value="no" selected >{{__('No')}}</option>`);
           }
           else if(data == no){
            $('#down'+id+'').append(`<option value="yes" selected >{{__('Yes')}}</option>`);
           }
           else{

           }
         });
</script>


<script>
  $(document).on('change', '.writingCountry', function(){  
           var id = $(this).attr("id"); 
           let data = $(this).val(); 
           $('#writingCity'+id+'').empty();
           $('#writingCity'+id+'').append(`<option value="0" disabled > {{__('Processing...')}} </option>`); 
           if($('#'+id+'').val != ''){ 
            $.ajax({
            type: 'GET',
            url: 'getwritingCityDynamic',
            data: { writingCountryDynamic: data },
            success: function (response) {
            var response = JSON.parse(response); 
            $('#writingCity'+id+'').empty();
            $('#writingCity'+id+'').append(`<option value="0" disabled selected >{{__('Select Writing City')}}</option>`);
            response.forEach(element => {
                $('#writingCity'+id+'').append(`<option value="${element['id']}">${element['city']}</option>`);
                });
            }
        });
            }
            else{
                $('#writingCity'+id+'').empty();
                $('#writingCity'+id+'').append(`<option value="0" disabled selected >{{__('Select Writing City')}}</option>`);
            }
      });

   $(document).on('change', '.reBookCat', function(){  
           var id = $(this).attr("id"); 
           let data = $(this).val(); 
           var book = "{{$bookBasicInfo->book->id}}";
           $('#relatedBook'+id+'').empty();
           $('#relatedBook'+id+'').append(`<option value="0" disabled > {{__('Processing...')}} </option>`); 
           if($('#'+id+'').val != ''){ 
            $.ajax({
            type: 'GET',
            url: 'getRelatedBookDynamic',
            data: { relatedBookDynamic: data, book: book },
            success: function (response) {
            var response = JSON.parse(response); 
            $('#relatedBook'+id+'').empty();
            
            $('#relatedBook'+id+'').append(`<option value="0" disabled selected >{{__('Select Related Book')}}</option>`);
            response.forEach(element => {
              
                $('#relatedBook'+id+'').append(`<option value="${element['id']}">${element['bookName']}</option>`);
                
              });
            }
        });
            }
            else{
                $('#relatedBook'+id+'').empty();
                $('#relatedBook'+id+'').append(`<option value="0" disabled selected >{{__('Select Related Book')}}</option>`);
            }
      });

  
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click', '.default_writing_place_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_default_writing_place'+button_id+'').remove();  
      });

    $(document).on('click', '.default_reference_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_default_reference'+button_id+'').remove();  
      });

    $(document).on('click', '.default_reviwed_book_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_default_reviwed_book'+button_id+'').remove();  
      });

    $(document).on('click', '.default_related_book_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row_default_related_book'+button_id+'').remove();  
      });
  });
</script>


<script src="{{asset('assets/backend/app-assets/js/scripts/form-select2.min.js')}}"></script>
<script src="{{asset('assets/backend/stepper/js/mstepper.js')}}"></script>

    

@endpush
