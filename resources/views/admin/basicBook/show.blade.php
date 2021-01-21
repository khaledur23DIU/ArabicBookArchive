@extends('layouts.backend.app')

@section('title', __('Book Basic Info'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/select.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/data-tables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
@endpush

@section('content')
<div class="col s12">
  <div class="container">
    <section class="users-list-wrapper section">
       <div class="section users-view">
		  
	<div class="card">
    <div class="card-content">
      <div class="row indigo lighten-5 border-radius-4 mb-2">
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">{{__('Book')}}: <span>{{$bookBasicInfo->book->bookName}}</span></h6>
        </div>
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">{{__('Author')}}: <span>{{$bookBasicInfo->book->person_book->person_list_bookable->personName}}</span>&nbsp<a class="btn gradient-45deg-purple-light-blue" href="{{ route('bookBasicInfo.edit',$bookBasicInfo->id) }}"><i class="material-icons">edit</i>{{__('Edit')}}</a>
          </h6>
        </div>
        
      </div>
      <div class="row">
        <div class="col s12">
          <table class="striped">
            <tbody>
              
              <tr>
                <td>{{__('Book Categories')}}:</td>
                <td>
                	@if (!empty($bookBasicInfo->book->book_categories))
                	@foreach ($bookBasicInfo->book->book_categories as $category)
                	<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="green-text">{{$category->bookCategory}}</span></span>
                    </span>
                    @endforeach
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
              <tr>
                <td>{{__('Starting Year')}}:</td>
                <td>
                	@if (!empty($bookBasicInfo->startYearHijri))
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp<span class="green-text">{{$bookBasicInfo->startYearHijri}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif

                    @if (!empty($bookBasicInfo->startYearIsae))
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp<span class="green-text">{{$bookBasicInfo->startYearIsae}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
              <tr>
                <td>{{__('Ending Year')}}:</td>
                <td>
                	@if (!empty($bookBasicInfo->endYearHijri))
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp<span class="green-text">{{$bookBasicInfo->endYearHijri}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif

                    @if (!empty($bookBasicInfo->endYearIsae))
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp<span class="green-text">{{$bookBasicInfo->endYearIsae}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
              <tr>
              	<td>{{__('Language')}}:</td>
              	<td>
              		@if (!empty($bookBasicInfo->languageID))
                	<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="green-text">{{$bookBasicInfo->language->language}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
              	</td>
              </tr>
            </tbody>
          </table>

          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('Writing Place Info')}}</h6>
          <table class="striped">
            <tbody>
            	@if (count($bookBasicInfo->book_basic_writing_places)!=0)
            	@foreach ($bookBasicInfo->book_basic_writing_places as $place)
            		
            	
              <tr>
                <td>{{__('Place')}}:</td>
                <td>
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Country')}}:&nbsp<span class="green-text">{{$place->writing_place->country->country}}</span></span>
                    </span>
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('City')}}:&nbsp<span class="green-text">{{$place->writing_place->city}}</span></span>
                    </span>
                </td>
              </tr>
              <tr>
                <td>{{__('Writing Period')}}:</td>
                <td>
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp @if (!empty($place->writingStartYearHijri)) <span class="green-text">{{$place->writingStartYearHijri}}</span>@else <span class="red-text">{{__('NA')}}</span> @endif -&nbsp @if (!empty($place->writingEndYearHijri)) <span class="green-text">{{$place->writingEndYearHijri}}</span>@else <span class="red-text">{{__('NA')}}</span> @endif</span>
                    </span>
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Iase')}}:&nbsp @if (!empty($place->writingStartYearIsae)) <span class="green-text">{{$place->writingStartYearIsae}}</span>@else <span class="red-text">{{__('NA')}}</span> @endif -&nbsp @if (!empty($place->writingEndYearIsae)) <span class="green-text">{{$place->writingEndYearIsae}}</span>@else <span class="red-text">{{__('NA')}}</span> @endif</span>
                    </span>
                </td>
              </tr>

              @endforeach
              @else
              <tr>
              	<td>{{__('Place')}}:</td>
              	<td>
              		<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                </td>
              </tr>
              @endif
              
            </tbody>
          </table>
          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('Reviwed Books')}}</h6>
          <table class="striped">
            <tbody>
            	@if (count($bookBasicInfo->book_basic_reviwes)!=0)
            		
            	@foreach ($bookBasicInfo->book_basic_reviwes as $key=> $review)
              <tr>
                <td>{{__('Review')}}-{{$key+1}}:</td>
	                <td>
	                	<span class="chip purple lighten-5">
                       		<span class="purple-text">{{__('Reviwed Book')}}: &nbsp<span class="green-text">{{$review->reviwed_book->bookName}}</span></span>
                    	</span>
                    	<p>{{$review->review}}</p>
	                </td>
              </tr>
            	@endforeach
              
              @else
              <tr>
              	<td>{{__('Review')}}:</td>
              	<td>
              		<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
              	</td>
              </tr>
              @endif
            </tbody>
          </table>

          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('Connected Books')}}</h6>
          <table class="striped">
            <tbody>
            	@if (count($bookBasicInfo->book_basic_connected_books)!=0)
            		
            	@foreach ($bookBasicInfo->book_basic_connected_books as $key=> $connected)
              <tr>
                <td>{{__('Connected Book')}}-{{$key+1}}:</td>
	                <td>
	                	<span class="chip purple lighten-5">
                       		<span class="purple-text">{{__('Name')}}:<span class="green-text">{{$connected->connected_book->bookName}}</span></span>
                    	</span>
                    	<span class="chip purple lighten-5">
                       		<span class="purple-text">{{__('Category')}}: &nbsp<span class="green-text">{{$connected->connected_book_category->bookCategory}}</span></span>
                    	</span>
                    	<span class="chip purple lighten-5">
                       		<span class="purple-text">{{__('Position Up')}}: &nbsp<span class="green-text">@if ($connected->positionUp == 0)
                       			{{__('Yes')}} @else {{__('No')}}
                       		@endif</span></span>
                    	</span>
	                </td>
              </tr>
            	@endforeach
              
              @else
              <tr>
              	<td>{{__('Connected Book')}}:</td>
              	<td>
              		<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
              	</td>
              </tr>
              @endif
            </tbody>
          </table>

          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('Index Informations')}}</h6>
          <table class="striped">
            <tbody>
              <tr>
                <td>{{__('Serial No')}}:</td>
                <td>
                	@if (!empty($bookBasicInfo->book_basic_index))
                       {{$bookBasicInfo->book_basic_index->SLNo}}
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
              <tr>
                <td>{{__('Index Line')}}:</td>
                <td>
                	@if (!empty($bookBasicInfo->book_basic_index))
                       {{$bookBasicInfo->book_basic_index->indexText}}
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
            </tbody>
          </table>

          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('Quotation Line')}} </h6>
          <table class="striped">
            <tbody>
              <tr>
                <td>{{__('Quotation')}}:</td>
                <td>
                	@if (!empty($bookBasicInfo->book_basic_quotation))
                       {{$bookBasicInfo->book_basic_quotation->quotation}}
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
            </tbody>
          </table>

          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('References')}} </h6>
          <table class="striped">
            <tbody>
            	@if (count($bookBasicInfo->book_basic_refs)!=0)
            		
            	@foreach ($bookBasicInfo->book_basic_refs as $key=> $ref)
              <tr>
                <td>{{__('Reference')}}-{{$key+1}}:</td>
	                <td>
	                	{{$ref->ref}}
	                </td>
              </tr>
            	@endforeach
              
              @else
              <tr>
              	<td>{{__('Reference')}}:</td>
              	<td>
              		<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
              	</td>
              </tr>
              @endif
            </tbody>
          </table>

        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>

	   
      </div>
    </section>
  </div>
</div>

  
@endsection

@push('js')
  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/js/scripts/data-tables.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/js/scripts/page-users.min.js')}}"></script>
@endpush
