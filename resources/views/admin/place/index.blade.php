@extends('layouts.backend.app')

@section('title', __('Places'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/form-select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/select2/select2-materialize.css')}}">
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
          <div class="col s3">
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <form action="{{ route('placeList.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="col s12 input-field">
                        <select class="select2 browser-default validate" id="country" name="country" required>
                          <option selected disabled>{{__('Select Country')}}</option>
                          @foreach ($countryLists as $country)
                          <option value="{{ $country->id }}">{!! $country->country !!}</option>
                          @endforeach
                        </select>
                        <label for="country">{{__('Country')}}</label>
                        @error('country')
                        <small class="red-text errorTxt1">{{ __($message) }}</small>
                        @enderror
                      </div>
                      <div class="col s12 input-field">
                        <input id="city" name="city" type="text" class="validate @error('city') is-invalid @enderror" value="{{ old('city') }}" autocomplete="city" required 
                          data-error=".errorTxt1">
                        <label for="city">{{ __('City') }}</label>
                        @error('city')
                        <small class="red-text errorTxt1">{{ __($message) }}</small>
                        @enderror
                      </div>
                      <div class="divider mb-3"></div>
                      <div class="col s12 display-flex justify-content-end mt-3">
                        <button type="submit" class="btn indigo">{{ __('Save') }}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col s9">
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <table id="page-length-option" class="display">
                      <thead>
                        <tr>
                          <th>{{__('SL')}}</th>
                          <th>{{__('City')}}</th>
                          <th>{{__('Country')}}</th>
                          <th>{{__('Country ISO Code2')}}</th>
                          <th>{{__('Country UN Code')}}</th>
                          <th>{{__('Action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($placeLists as $key => $place)
                          <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"> @if(!empty($place->city))<span class="purple-text">{!! $place->city !!}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"> @if(!empty($place->country->country))<span class="purple-text">{!! $place->country->country !!}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"> @if(!empty($place->country->country_iso_code_2))<span class="purple-text">{!! $place->country->country_iso_code_2 !!}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"> @if(!empty($place->country->country_un_code))<span class="purple-text">{!! $place->country->country_un_code !!}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                              </span>
                            </td>
                            
                            <td>
                              <a href="{{ route('placeList.edit',$place->id) }}"><i class="material-icons">edit</i></a>
                              <a onclick="deleteRow({{ $place->id }})"><i class="material-icons">delete</i></a>
                                <form id="delete-form-{{ $place->id }}" action="{{ route('placeList.destroy',$place->id) }}" method="POST" style="display: none;">
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
  </div>
</div>

  
@endsection

@push('js')
  <script src="{{asset('assets/backend/app-assets/vendors/jquery-validation/jquery.validate.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/js/scripts/form-validation.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/vendors/select2/select2.full.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/js/scripts/form-select2.min.js')}}"></script>
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
  </script>
@endpush
