@extends('layouts.backend.app')

@section('title', __('Role view'))

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
		  <div class="card-panel">
		    <div class="row">
		      <div class="col s12 m7">
		        <div class="display-flex media">
		          <div class="media-body">
		            <h6 class="media-heading">
		              <span>{{ $role->name }}</span>
		              <span class="grey-text">@</span>
		              <span>{{$role->guard_name}}</span>
		            </h6>
		            <span>{{__('Created')}}:</span>
		            <span >{{ $role->created_at->toFormattedDateString()}}</span>
		          </div>
		        </div>
		      </div>
		      <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
		        @if ($role->id != '1')
		        <a href="{{ route('roles.edit',$role->id) }}" class="btn-small indigo">Edit</a>
		        @endif
		      </div>
		    </div>
		  </div>

	  <div class="card">
	    <div class="card-content">
	      <div class="row">
	        <div class="col s12 m4">
	          <table class="striped">
	            <tbody>
	              <tr>
	                <td>{{__('Role')}}:</td>
	                <td>{{ $role->name}}</td>
	              </tr>
	              <tr>
	                <td>{{__('Guard')}}:</td>
	                <td >{{$role->guard_name}}</td>
	              </tr>
	              <tr>
	                <td>{{__('Created')}}:</td>
	                <td >{!! $role->created_at->toFormattedDateString() !!}</td>
	              </tr>
	              <tr>
	                <td>{{__('Updated')}}:</td>
	                <td >{{$role->updated_at->toFormattedDateString() != NULL ? $role->updated_at->toFormattedDateString(): 'Not Yet'}}</td>
	              </tr>
	            </tbody>
	          </table>
	        </div>

	        <div class="col s12 m8">
	          <table class="responsive-table">
	            <thead>
	              <tr>
	                <th>{{__('Module Permission')}}</th>
	                <th>{{__('Create')}}</th>
	                <th>{{__('Read')}}</th>
	                <th>{{__('Update')}}</th>
	                <th>{{__('Delete')}}</th>
	              </tr>
	            </thead>
	            <tbody >
	              @foreach ($permissions as $module => $permissions)
	              <tr>
	                <td>{!! $module !!}</td>
	                  <td>
	                @foreach ($permissions as $permission)
	                @if ($module.'-create' == $permission->name)
	                  <label>
	                    <input type="checkbox" @foreach ($rolePermissions as $rolePermission)
	                    	{{ $permission->id == $rolePermission->id ? 'checked disabled': 'disabled'}}
	                    @endforeach name="permissions[]" value="{{$permission->id}}" />
	                    <span></span>
	                  </label>
	                @endif
	                @endforeach
	                </td>
	                <td>
	                @foreach ($permissions as $permission)
	                @if ($module.'-list' == $permission->name)
	                  <label>
	                    <input type="checkbox" @foreach ($rolePermissions as $rolePermission)
	                    	{{ $permission->id == $rolePermission->id ? 'checked disabled': 'disabled'}}
	                    @endforeach name="permissions[]" value="{{$permission->id}}" />
	                    <span></span>
	                  </label>
	                @endif
	                @endforeach
	                </td>
	                <td>
	                @foreach ($permissions as $permission)
	                @if ($module.'-edit' == $permission->name)
	                  <label>
	                    <input type="checkbox" @foreach ($rolePermissions as $rolePermission)
	                    	{{ $permission->id == $rolePermission->id ? 'checked disabled': 'disabled'}}
	                    @endforeach name="permissions[]" value="{{$permission->id}}" />
	                    <span></span>
	                  </label>
	                @endif
	                @endforeach
	                </td>
	                <td>
	                @foreach ($permissions as $permission)
	                @if ($module.'-delete' == $permission->name)
	                  <label>
	                    <input type="checkbox" @foreach ($rolePermissions as $rolePermission)
	                    	{{ $permission->id == $rolePermission->id ? 'checked disabled': 'disabled'}}
	                    @endforeach name="permissions[]" value="{{$permission->id}}" />
	                    <span></span>
	                  </label>
	                @endif
	                @endforeach
	                </td>
	              </tr>
	              @endforeach
	            </tbody>
	          </table>
	        </div>
	      </div>
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
