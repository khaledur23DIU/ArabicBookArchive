@extends('layouts.backend.app')

@section('title', __('Library Info'))

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
          <h6 class="indigo-text m-0">{{__('Library')}}: <span>{{$library->libraryName}}</span></h6>
        </div>

        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">{{__('In')}}: <span>{{$library->place->city}}&nbsp,{{$library->place->country->country}}</span>
          <a class="btn gradient-45deg-purple-light-blue" href="{{ route('libraryList.edit',$library->id) }}"><i class="material-icons">edit</i>{{__('Edit')}}</a>
          </h6>
        </div>
        
      </div>
      <div class="row">
        <div class="col s12">
          <table class="striped">
            <tbody>
              
              <tr>
                <td>{{__('Stablished Year')}}:</td>
                <td>
                	
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp @if (!empty($library->stablishedYearHijri))<span class="green-text">{{$library->stablishedYearHijri}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp @if (!empty($library->stablishedYearIsae))<span class="green-text">{{$library->stablishedYearIsae}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                </td>
              </tr>
              
              <tr>
              	<td>{{__('Website')}}:</td>
              	<td>
              		@if (!empty($library->web))
              			<a href="{{$library->web}}" add target="_blank"><span class="purple-text">{{$library->web}}</span></a>
              			
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
              		@if (!empty($library->email))
              			<a href="mailto:{{$library->email}}"><span class="purple-text">{{$library->email}}</span></a>
              			
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
              		@if (!empty($library->phone))
              			<a href="tel:{{$library->phone}}"><span class="purple-text">{{$library->phone}}</span></a>
              			
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
              		@if (!empty($library->mobile))
              			<a href="tel:{{$library->mobile}}"><span class="purple-text">{{$library->mobile}}</span></a>
              			
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
              		@if (!empty($library->facebook))
              			<a href="{{$library->facebook}}" add target="_blank"><span class="purple-text">{{$library->facebook}}</span></a>
              			
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
              		@if (!empty($library->twitter))
              			<a href="{{$library->twitter}}" add target="_blank"><span class="purple-text">{{$library->twitter}}</span></a>
              			
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
              		@if (!empty($library->instagram))
              			<a href="{{$library->instagram}}" add target="_blank"><span class="purple-text">{{$library->instagram}}</span></a>
              			
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
              		@if (!empty($library->linkedIn))
              			<a href="{{$library->linkedIn}}" add target="_blank"><span class="purple-text">{{$library->linkedIn}}</span></a>
              			
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
              		@if (!empty($library->youtube))
              			<a href="{{$library->youtube}}" add target="_blank"><span class="purple-text">{{$library->youtube}}</span></a>
              			
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
              		@if (!empty($library->locationMapLink))
              			<a href="{{$library->locationMapLink}}" add target="_blank"><span class="purple-text">{{$library->locationMapLink}}</span></a>
              			
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
