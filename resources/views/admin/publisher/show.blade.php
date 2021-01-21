@extends('layouts.backend.app')

@section('title', __('Publisher Info'))

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
        <div class="col s12 m6 users-view-timeline">
          <h6 class="indigo-text m-0">{{__('Publisher Name')}}: <span>{{$publisher->publicationName}}</span>&nbsp @if (!empty($publisher->placeID))
           {{__('in')}} &nbsp <span class="purple-text">{{$publisher->place->city}}&nbsp , {{$publisher->place->country->country}}</span> @endif </h6>
        </div>

        <div class="col s12 m6 users-view-timeline">
          <h6 class="indigo-text m-0">{{__('Owner is')}}: <span>{{$publisher->person->personName}}</span><a class="btn gradient-45deg-purple-light-blue" href="{{ route('publicationInfo.edit',$publisher->id) }}"><i class="material-icons">edit</i>{{__('Edit')}}</a>
          </h6>
        </div>
        
      </div>
      <div class="row">
        <div class="col s12">
          <table class="striped">
            <tbody>
              
              
              <tr>
                <td>{{__('Established Year')}}:</td>
                <td>
                	
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp @if (!empty($publisher->stablishedYearHijri))<span class="green-text">{{$publisher->stablishedYearHijri}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp @if (!empty($publisher->stablishedYearIsae))<span class="green-text">{{$publisher->stablishedYearIsae}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                </td>
              </tr>
              
              <tr>
              	<td>{{__('Website')}}:</td>
              	<td>
              		@if (!empty($publisher->web))
              			<a href="{{$publisher->web}}" add target="_blank"><span class="purple-text">{{$publisher->web}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Email')}}:</td>
              	<td>
              		@if (!empty($publisher->email))
              			<a href="mailto:{{$publisher->email}}"><span class="purple-text">{{$publisher->email}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Phone')}}:</td>
              	<td>
              		@if (!empty($publisher->phone))
              			<a href="tel:{{$publisher->phone}}"><span class="purple-text">{{$publisher->phone}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>

              <tr>
              	<td>{{__('Mobile')}}:</td>
              	<td>
              		@if (!empty($publisher->mobile))
              			<a href="tel:{{$publisher->mobile}}"><span class="purple-text">{{$publisher->mobile}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Facebook')}}:</td>
              	<td>
              		@if (!empty($publisher->facebook))
              			<a href="{{$publisher->facebook}}" add target="_blank"><span class="purple-text">{{$publisher->facebook}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>

              <tr>
              	<td>{{__('Twitter')}}:</td>
              	<td>
              		@if (!empty($publisher->twitter))
              			<a href="{{$publisher->twitter}}" add target="_blank"><span class="purple-text">{{$publisher->twitter}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Instagram')}}:</td>
              	<td>
              		@if (!empty($publisher->instagram))
              			<a href="{{$publisher->instagram}}" add target="_blank"><span class="purple-text">{{$publisher->instagram}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('LinkedIn')}}:</td>
              	<td>
              		@if (!empty($publisher->linkedIn))
              			<a href="{{$publisher->linkedIn}}" add target="_blank"><span class="purple-text">{{$publisher->linkedIn}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Youtube')}}:</td>
              	<td>
              		@if (!empty($publisher->youtube))
              			<a href="{{$publisher->youtube}}" add target="_blank"><span class="purple-text">{{$publisher->youtube}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Location Map Link')}}:</td>
              	<td>
              		@if (!empty($publisher->locationMapLink))
              			<a href="{{$publisher->locationMapLink}}" add target="_blank"><span class="purple-text">{{$publisher->locationMapLink}}</span></a>
              			
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              
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
