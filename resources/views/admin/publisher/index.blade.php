@extends('layouts.backend.app')

@section('title', __('Libraries'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/select.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/data-tables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
@endpush

@section('content')
    <div class=" col s12 m6">
        <a class="btn gradient-45deg-cyan-light-green" href="{{ route('publicationInfo.create') }}">{{__('Create New')}}</a>
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
                          <th>{{__('.SL')}}</th>
                          <th>{{__('Publication')}}</th>
                          <th>{{__('Email')}}</th>
                          <th>{{__('Website')}}</th>
                          <th>{{__('Phone')}}</th>
                          <th>{{__('Mobile')}}</th>
                          <th>{{__('Created At')}}</th>
                          <th>{{__('Action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($pubLists as $key => $list)
                          <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"><span class="purple-text">{!! $list->publicationName !!}</span></span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"> @if(!empty($list->web))<span class="purple-text">{!! $list->web !!}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"> @if(!empty($list->email))<a href="mailto:{!! $list->email !!}"><span class="purple-text">{!! $list->email !!}</span></a> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"> @if(!empty($list->phone))<span class="purple-text">{!! $list->phone !!}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"> @if(!empty($list->mobile))<span class="purple-text">{!! $list->mobile !!}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"><span class="purple-text">{!! $list->created_at->toFormattedDateString() !!}</span>
                              </span>
                              </span>
                            </td>
                            <td>
                              <a href="{{ route('publicationInfo.show',$list->id) }}"><i class="material-icons">remove_red_eye</i></a>
                              <a href="{{ route('publicationInfo.edit',$list->id) }}"><i class="material-icons">edit</i></a>
                              <a onclick="deleteUser({{ $list->id }})"><i class="material-icons">delete</i></a>
                                <form id="delete-form-{{ $list->id }}" action="{{ route('publicationInfo.destroy',$list->id) }}" method="POST" style="display: none;">
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
  </script>
@endpush
