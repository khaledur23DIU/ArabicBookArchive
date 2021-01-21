@extends('layouts.backend.app')

@section('title', __('Person Info'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/select.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/data-tables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
@endpush

@section('content')
    <div class=" col s12 m6">
        <a class="btn gradient-45deg-cyan-light-green" href="{{ route('person-info.create') }}">{{__('Create New')}}</a>
    </div>
    <section class="users-list-wrapper section">
      <div class="section section-data-tables">
        <div class="row">
          <div class="col s12">
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <table id="page-length-option" class="display">
                      <thead>
                        <tr>
                          <th>{{__('.SL')}}</th>
                          <th>{{__('Name')}}</th>
                          <th>{{__('Fathers Name')}}</th>
                          <th>{{__('Birth Info.')}}</th>
                          <th>{{__('Death Info.')}}</th>
                          <th>{{__('Kuniad')}}</th>
                          <th>{{__('Action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($personLists as $key => $person)
                          <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>
                              @if (!empty($person->personName))
                                <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="green-text"><a href="{{ route('person-info.show',$person->id) }}">{!! $person->personName !!}</a></span></span>
                                </span>
                                @else
                                  <span class="chip purple lighten-5">
                                  <span class="purple-text"><span class="red-text">{{__('NA') }}</span></span>
                                  </span>
                                @endif
                            </td>
                            <td>
                              @if (!empty($person->fathersName))
                                <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="green-text">{!! $person->fathersName !!}</span></span>
                                </span>
                                @else
                                  <span class="chip purple lighten-5">
                                  <span class="purple-text"><span class="red-text">{{__('NA') }}</span></span>
                                  </span>
                                @endif
                            </td>
                            <td>
                                  @if (!empty($person->birthPlaceID))
                                    <span class="chip purple lighten-5">
                                    <span class="purple-text">{{__('Country')}}: <span class="green-text">{!! $person->birthPlace->country->country !!}</span></span>
                                    <span class="purple-text">{{__('City')}}: <span class="green-text">{!! $person->birthPlace->city !!}</span></span>
                                    </span>
                                  @else
                                  <span class="chip purple lighten-5">
                                    <span class="purple-text">{{__('Country')}}: <span class="red-text">{{__('NA') }}</span></span>
                                    <span class="purple-text">{{__('City')}}: <span class="red-text">{{__('NA') }}</span></span>
                                    </span>
                                  @endif
                                  
                                @if (!empty($person->birthYearHijri))
                                  <span class="chip purple lighten-5">
                                  <span class="purple-text">{{__('Hijri')}}: {!! $person->birthYearHijri !!}</span>
                                  <span class="purple-text">{{__('Isae')}}: {!! $person->birthYearIsae !!}</span>
                                  </span>
                                @else
                                  <span class="chip purple lighten-5">
                                  <span class="purple-text">{{__('Hijri')}}: <span class="red-text">{{__('NA') }}</span></span>
                                  <span class="purple-text">{{__('Isae')}}: <span class="red-text">{{__('NA') }}</span></span>
                                  </span>
                                @endif
                            </td>
                            <td>
                                @if (!empty($person->deathPlaceID))
                                    <span class="chip purple lighten-5">
                                    <span class="purple-text">{{__('Country')}}: <span class="green-text">{!! $person->deathPlace->country->country !!}</span></span>
                                    <span class="purple-text">{{__('City')}}: <span class="green-text">{!! $person->deathPlace->city !!}</span></span>
                                    </span>
                                @else
                                    <span class="chip purple lighten-5">
                                    <span class="purple-text">{{__('Country')}}: <span class="red-text">{{__('NA') }}</span></span>
                                    <span class="purple-text">{{__('City')}}: <span class="red-text">{{__('NA') }}</span></span>
                                    </span>
                                @endif
                                @if (!empty($person->deathYearHijri))
                                  <span class="chip purple lighten-5">
                                  <span class="purple-text">{{__('Hijri')}}: {!! $person->deathYearHijri !!}</span>
                                  <span class="purple-text">{{__('Isae')}}: {!! $person->deathYearIsae !!}</span>
                                  </span>
                                @else
                                  <span class="chip purple lighten-5">
                                  <span class="purple-text">{{__('Hijri')}}: <span class="red-text">{{__('NA') }}</span></span>
                                  <span class="purple-text">{{__('Isae')}}: <span class="red-text">{{__('NA') }}</span></span>
                                  </span>
                                @endif
                                
                            </td>
                            
                            <td>
                              @if (!empty($person->kuniad))
                                <span class="chip purple lighten-5">
                                  <span class="green-text">{{ $person->kuniad }}</span>
                                </span>
                              @else
                                <span class="chip purple lighten-5">
                                  <span class="red-text">{{__('NA') }}</span>
                                </span>
                              
                              @endif
                            </td>
                            
                            <td>
                              <a href="{{ route('person-info.show',$person->id) }}"><i class="material-icons">remove_red_eye</i></a>
                              <a href="{{ route('person-info.edit',$person->id) }}"><i class="material-icons">edit</i></a>
                              <a onclick="deleteUser({{ $person->id }})"><i class="material-icons">delete</i></a>
                                <form id="delete-form-{{ $person->id }}" action="{{ route('person-info.destroy',$person->id) }}" method="POST" style="display: none;">
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
              confirmButtonText: "{{ __('Yes, delete it!') }}",
              cancelButtonText: "{{ __('No, cancel!') }}",
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
