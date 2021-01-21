@extends('layouts.backend.app')

@section('title', __('Roles'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/select.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/data-tables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
@endpush

@section('content')
<div class="col s12">
  <div class="container">
    <section class="users-list-wrapper section"> 
      <div class="section section-data-tables">
        <div class="row">
          <div class="col s6">
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <form id="update-form-{{ $role->id }}" action="{{ route('roles.update',$role->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="col s12 input-field">
                        <input id="name" name="name" type="text" class="validate @error('name') is-invalid @enderror" value="{{ $role->name }}" autocomplete="mazhabType" placeholder="{{__('Role Name')}}" required 
                          data-error=".errorTxt1">
                        <label for="name">{{ __('Role Name') }}</label>
                        @error('name')
                        <small class="errorTxt1">{{ __($message) }}</small>
                        @enderror
                      </div>
                      <div class="divider mb-3"></div>
                      <table class="mt-1">
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
	                    	{{ $permission->id == $rolePermission->id ? 'checked': ''}}
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
	                    	{{ $permission->id == $rolePermission->id ? 'checked': ''}}
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
	                    	{{ $permission->id == $rolePermission->id ? 'checked': ''}}
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
	                    	{{ $permission->id == $rolePermission->id ? 'checked': ''}}
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
                      <div class="divider mb-3"></div>
                      <div class="col s12 display-flex justify-content-end mt-3">
                        <button type="button" onclick="updateRow({{ $role->id }})" class="btn indigo">{{ __('Update') }}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s6">
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <table id="page-length-option" class="display">
                      <thead>
                        <tr>
                          <th>{{__('SL')}}</th>
                          <th>{{__('Role')}}</th>
                          <th>{{__('Guard')}}</th>
                          <th>{{__('Created At')}}</th>
                          <th>{{__('Action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($roles as $key => $role)
                          <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>{!! $role->name !!}</td>
                            <td>{!! $role->guard_name !!}</td>
                            <td>{!! $role->created_at->toFormattedDateString() !!}</td>
                            <td>
                              <a href="{{ route('roles.show',$role->id) }}"><i class="material-icons">remove_red_eye</i></a>
                              @if ($role->id != '1')
                                <a href="{{ route('roles.edit',$role->id) }}"><i class="material-icons">edit</i></a>
                              <a onclick="deleteRow({{ $role->id }})"><i class="material-icons">delete</i></a>
                                <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy',$role->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                              @endif
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
  <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
  <script type="text/javascript">
      function deleteRow(id) {
          swal({
              title: "{{__('Are you sure?')}}",
              text: "{{__('You wont be able to revert this!')}}",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: "{{__('Yes, delete it!')}}",
              cancelButtonText: "{{__('No, cancel!')}}",
              confirmButtonClass: 'btn indigo',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
              reverseButtons: false
          }).then((result) => {
              if (result.value) {
                  event.preventDefault();
                  document.getElementById('delete-form-'+id).submit();
              } else if (
                  // Read more about handling dismissals
                  result.dismiss === swal.DismissReason.cancel
              ) {
                  swal(
                      "{{__('Cancelled')}}",
                      "{{__('Your data is safe :)')}}",
                      "{{__('error')}}"
                  )
              }
          })
      }

      function updateRow(id) {
          swal({
              title: "{{__('Are you sure?')}}",
              text: "{{__('You want to update this!')}}",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: "{{__('Yes, update it!')}}",
              cancelButtonText: "{{__('No, cancel!')}}",
              confirmButtonClass: 'btn indigo',
              cancelButtonClass: 'btn btn-danger',
              buttonsStyling: false,
              reverseButtons: false
          }).then((result) => {
              if (result.value) {
                  event.preventDefault();
                  document.getElementById('update-form-'+id).submit();
              } else if (
                  // Read more about handling dismissals
                  result.dismiss === swal.DismissReason.cancel
              ) {
                  swal(
                      "{{__('Cancelled')}}",
                      "{{__('Your data is safe :)')}}",
                      "{{__('error')}}"
                  )
              }
          })
      }
  </script>
@endpush
