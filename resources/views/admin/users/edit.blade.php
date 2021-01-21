@extends('layouts.backend.app')

@section('title', __('Edit User'))

@push('css')
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('assets/backend/app-assets/vendors/select2/select2-materialize.css')}}" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
@endpush

@section('content')
<div class="section users-edit">
  <div class="card">
    <div class="card-content">
      <!-- <div class="card-body"> -->
      <ul class="tabs mb-2 row">
        <li class="tab">
          <a class="display-flex align-items-center active" id="account-tab" href="#account">
            <i class="material-icons mr-1">person_outline</i><span>{{__('Account Info')}}</span>
          </a>
        </li>
      </ul>
      <div class="divider mb-3"></div>
      <div class="row">
        <div class="col s12" id="account">
          <form id="update-form-{{ $user->id }}" action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
          	@csrf
          	@method('PUT')
            <div class="row">
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12 input-field">
                    <input id="name" name="name" type="text" class="validate @error('name') is-invalid @enderror" value="{{ $user->name }}" autocomplete="name" autofocus placeholder="{{__('User name')}}" required 
                      data-error=".errorTxt1">
                    <label for="name">{{ __('Name') }}</label>
                    @error('name')
                    <small class="errorTxt1">{{ __($message) }}</small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="email" name="email" type="email" class="validate @error('email') is-invalid @enderror" value="{{ $user->email }}" autocomplete="email" placeholder="{{__('User Email')}}" required 
                      data-error=".errorTxt2">
                    <label for="email">{{ __('Email') }}</label>
                    <small class="errorTxt2"></small>
                    @error('email')
                    <small class="errorTxt2">{{ __($message) }}}</small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <select id="roles" name="roles[]" multiple="multiple">
                      	<option disabled="true" value="">...{{__('Select')}}...</option>
                      @foreach ($roles as $role)  
                      	<option 
                      		@foreach ($userRoles as $attachedRoles)
                                {{ $attachedRoles->id == $role->id ? 'selected' : '' }}
                             @endforeach
								value="{{$role->id}}">{!! $role->name !!} </option>
                      @endforeach
                    </select>
                    <label for="roles">{{ __('Roles') }}</label>
                  </div>
                </div>
              </div>
              <div class="col s12 m6">
                <div class="row">
                  <div class="col s12 input-field">
                    <input id="password" name="password" type="password" class="validate @error('password') is-invalid @enderror" autocomplete="new-password" placeholder="{{__('Password')}}" required
                      data-error=".errorTxt2">
                    <label for="password">{{ __('Password') }}</label>
                    @error('password')
                    <small class="errorTxt2">{{ __($message) }}}</small>
                    @enderror
                  </div>
                  <div class="col s12 input-field">
                    <input id="confirm-password" name="confirm-password" type="password" class="validate" autocomplete="new-password" placeholder="{{__('Retype Password')}}" required
                      data-error=".errorTxt2">
                    <label for="confirm-password">{{ __('Confirm Password') }}</label>
                    <small class="errorTxt2"></small>
                  </div>
                  <div class="col s12 input-field">
                    <select id="status" name="status">
                      <option disabled="true" value="">...{{__('Select')}}...</option>
                      <option value="1">{{__('Active')}}</option>
                      <option value="0">{{__('Close')}}</option>
                    </select>
                    <label for="status">{{ __('Status') }}</label>
                  </div>
                </div>
              </div>
              <div class="col s12">
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
                  <tbody>
                    @foreach ($permissions as $module => $permissions)
                    <tr>
                      <td>{!! $module !!}</td>
                  		@foreach ($permissions as $permission)
                  		
                      <td>
                        <label>
                          <input type="checkbox" @foreach ($userRoles as $userRole)
                  		@foreach ($userRole->permissions as $element) {{ $permission->id == $element->id ? 'checked disabled': 'disabled'}} @endforeach
                      	@endforeach />
                          <span></span>
                        </label>
                      </td>
                      	
                    	@endforeach
                    </tr>
                  	@endforeach
                  </tbody>
                </table>
                <!-- </div> -->
              </div>
              <div class="col s12 display-flex justify-content-end mt-3">
                <button type="button" onclick="updateRow({{ $user->id }})" class="btn indigo">
                  {{ __('Update') }}</button>
                <button type="button" class="btn btn-light">{{ __('Cancel') }}</button>
              </div>
            </div>
          </form>
          <!-- users edit account form ends -->
        </div>
      </div>
      <!-- </div> -->
    </div>
  </div>
</div>
@endsection

@push('js')
	<script src="{{asset('assets/backend/app-assets/vendors/select2/select2.full.min.js')}}"></script>
	<script src="{{asset('assets/backend/app-assets/vendors/jquery-validation/jquery.validate.min.js')}}">   </script>
  	<script src="{{asset('assets/backend/app-assets/js/scripts/page-users.min.js')}}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

    <script type="text/javascript">
      function updateRow(id) {
          swal({
              title: "{{__('Are you sure?')}}",
              text: "{{__('You want to update this!')}}",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, update it!',
              cancelButtonText: 'No, cancel!',
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
