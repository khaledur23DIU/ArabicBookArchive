@extends('layouts.backend.app')

@section('title', __('Mazhab'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/form-select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/select2/select2-materialize.css')}}">
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
                    <form id="formValidate" action="{{ route('mazhabList.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="col s12 input-field">
                        <select class="select2 browser-default validate" id="mazhabType" name="mazhabType" required>
                          <option selected disabled>{{__('Select Mazhab Type')}}</option>
                          @foreach ($mazhabTypes as $mazhabType)
                          <option value="{{ $mazhabType->id }}">{!! $mazhabType->mazhabType !!}</option>
                          @endforeach
                        </select>
                        <label for="mazhabType">{{__('Mazhab Type')}}</label>
                        @error('mazhabType')
                        <small class="red-text errorTxt1">{{ __($message) }}</small>
                        @enderror
                      </div>
                      <div class="col s12 input-field">
                        <input id="mazhab" name="mazhab" type="text" class="validate @error('mazhab') is-invalid @enderror" value="{{ old('mazhab') }}" required data-error=".errorTxt1">
                        <label for="mazhab">{{ __('Mazhab') }}</label>
                        @error('mazhab')
                        <small class="red-text .errorTxt1">{{ __($message) }}</small>
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
                    <table id="page-length-option" class="display table">
                      <thead>
                        <tr>
                          <th>{{__('.SL')}}</th>
                          <th>{{__('Mazhab')}}</th>
                          <th>{{__('Mazhab Type')}}</th>
                          <th>{{__('Created At')}}</th>
                          <th>{{__('Action')}}</th>
                        </tr>
                      </thead>
                      <tbody id="append">
                          @foreach ($mazhabList as $key => $mazhab)
                          <tr id="tr_{{$mazhab->id}}">
                            <td>{!! $key+1 !!}</td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"><span class="purple-text">{!! $mazhab->mazhabName !!}</span>
                              </span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"><span class="purple-text">{!! $mazhab->mazhabTyp->mazhabType !!}</span>
                              </span>
                              </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                              <span class="purple-text"><span class="purple-text">{!! $mazhab->created_at->toFormattedDateString() !!}
                              </span>
                              </span>
                              </span>
                            </td>
                            <td>
                              <a href="{{ route('mazhabList.edit',$mazhab->id) }}"><i class="material-icons">edit</i></a>
                              <a onclick="deleteRow({{ $mazhab->id }})"><i class="material-icons">delete</i></a>
                                <form id="delete-form-{{ $mazhab->id }}" action="{{ route('mazhabList.destroy',$mazhab->id) }}" method="POST" style="display: none;">
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
              confirmButtonColor: '#8bc34a light-green',
              cancelButtonColor: '#b71c1c red darken-4',
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
