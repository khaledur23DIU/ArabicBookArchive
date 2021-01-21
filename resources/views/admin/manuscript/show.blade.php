@extends('layouts.backend.app')

@section('title', __('Manuscript Info'))

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
          <h6 class="indigo-text m-0">{{__('Manuscript')}}: <span>{{$manuscript->book->bookName}}</span></h6>
        </div>

        <div class="col s12 m4 users-view-timeline">
          <a href="{{ route('libraryList.show',$manuscript->library->id) }}"><h6 class="indigo-text m-0">{{__('Library')}}: <span>{{$manuscript->library->libraryName}}</span></h6></a><a class="btn gradient-45deg-purple-light-blue" href="{{ route('manuscriptInfo.edit',$manuscript->id) }}"><i class="material-icons">edit</i>{{__('Edit')}}</a>
        </div>
        
      </div>
      <div class="row">
        <div class="col s12">
          <table class="striped">
            <tbody>
              
              <tr>
                <td>{{__('Index In Library')}}:</td>
                <td>
                	@if (!empty($manuscript->indexInLibrary))
                	
                	{{$manuscript->indexInLibrary}}
                    
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
              <tr>
                <td>{{__('Written Year')}}:</td>
                <td>
                	
                	<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp @if (!empty($manuscript->writtenYearHijri))<span class="green-text">{{$manuscript->writtenYearHijri}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp @if (!empty($manuscript->writtenYearIsae))<span class="green-text">{{$manuscript->writtenYearIsae}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                </td>
              </tr>
              <tr>             
              	<td>{{__('Parts and Pages')}}:</td>
              	<td>
              		<span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Parts')}}:&nbsp @if (!empty($manuscript->partCount))<span class="green-text">{{$manuscript->partCount}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Pages')}}:&nbsp @if (!empty($manuscript->pageCount))<span class="green-text">{{$manuscript->pageCount}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Line Count Per-page')}}:&nbsp @if (!empty($manuscript->lineCountPerPage))<span class="green-text">{{$manuscript->lineCountPerPage}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
              	</td>
              	
              </tr>
              <tr>
              	<td>{{__('Starting Lines')}}:</td>
              	<td>
              		@if (!empty($manuscript->someStratingLine))
              			{{$manuscript->someStratingLine}}
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Ending Lines')}}:</td>
              	<td>
              		@if (!empty($manuscript->someEndingLine))
              			{{$manuscript->someEndingLine}}
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Error')}}:</td>
              	<td>
              		@if (!empty($manuscript->errors))
              			{{$manuscript->errors}}
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Description')}}:</td>
              	<td>
              		@if (!empty($manuscript->description))
              			{{$manuscript->description}}
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>
              <tr>
              	<td>{{__('Pdf Link')}}:</td>
              	<td>
              		@if (!empty($manuscript->pdfLink))
              			{{$manuscript->pdfLink}}
              		@else
              			<span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    	</span>
              		@endif
              	</td>
              </tr>

              <tr>
              	<td>{{__('Writers')}}:</td>
              	<td>
              		@if (count($manuscript->manuscript_writers)!=0)
              			@foreach ($manuscript->manuscript_writers as $writer)
              			<a href="{{ route('person-info.show',$writer->id) }}"><span class="chip purple lighten-5">
                       	<span class="purple-text">{{__('Writer')}}:&nbsp <span class="green-text">{{$writer->personName}}</span></span>
                       </span>
                       </a>
                    	@endforeach
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
