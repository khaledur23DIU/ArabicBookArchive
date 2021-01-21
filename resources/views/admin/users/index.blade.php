@extends('layouts.backend.app')

@section('title', __('All Users'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/select.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/data-tables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
@endpush

@section('content')
    <div class=" col s12 m6">
        <a class="btn gradient-45deg-cyan-light-green" href="{{ route('users.create') }}">{{__('Create New')}}</a>
    </div>
    <section class="users-list-wrapper section">  
      <div class="section section-data-tables">
        <div class="row">
          <div class="col s12">
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <table id="page-length-option"  class="display">
                      <thead>
                        <tr>
                          <th>.{{('SL')}}</th>
                          <th>{{('User Name')}}</th>
                          <th>{{('Email')}}</th>
                          <th>{{('Roles')}}</th>
                          <th>{{('Status')}}</th>
                          <th>{{('Created At')}}</th>
                          <th>{{('Action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($data as $key => $user)
                          <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>
                                <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="purple-text">{!! $user->name !!}</span></span>
                                </span>
                            </td>
                            <td>
                                <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="purple-text">{!! $user->email !!}</span></span>
                                </span>
                            </td>
                            <td>
                              @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $role)
                                  <span class="chip purple lighten-5">
                                    <span class="purple-text">{!! $role !!}</span>
                                  </span>
                                @endforeach
                              @endif
                            </td>
                            <td>
                              @if (!empty($user->profile))
                                @if ($user->profile->account_status == 1)
                                <span class="chip green lighten-5">
                                <span class="green-text">{{__("Active")}}</span>
                                </span>
                                @else
                                <span class="chip red lighten-5">
                                <span class="red-text">{{__("Inactive")}}</span>
                                </span>
                                @endif
                              @else
                                <span class="chip purple lighten-5">
                                <span class="red-text">{{__("NA")}}</span>
                                </span>
                              @endif
                            </td>
                            <td>
                                <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="purple-text">{!! $user->created_at->toFormattedDateString() !!}</span></span>
                                </span>
                            </td>
                            <td>
                              <a href="{{ route('users.edit',$user->id) }}"><i class="material-icons">edit</i></a>
                              <a onclick="deleteUser({{ $user->id }})"><i class="material-icons">delete</i></a>
                                <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy',$user->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
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
  
@endsection

@push('js')
  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/js/scripts/data-tables.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/js/scripts/page-users.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
  <script type="text/javascript">
      function deleteUser(id) {
          swal({
              title: "{{__('Are you sure?')}}",
              text: "{{__('You wont be able to revert this!')}}",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: "{{('Yes, delete it!')}}",
              cancelButtonText: "{{('No, cancel!')}}",
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
  </script>
@endpush
