@extends('layouts.backend.app')

@section('title', __('Languages'))

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
          <div class="col s3">
            <div class="card">
              <div class="card-content">
                <div class="row">
                  <div class="col s12">
                    <form action="{{ route('languageList.update',$language->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="col s12 input-field">
                        <input id="language" name="language" type="text" class="validate @error('language') is-invalid @enderror" value="{{ $language->language }}" autocomplete="language" required 
                          data-error=".errorTxt1">
                        <label for="language">{{ __('Language') }}</label>
                        @error('language')
                        <small class="red-text errorTxt1">{{ __($message) }}</small>
                        @enderror
                      </div>
                      <div class="col s12 input-field">
                        <input id="language_iso_code_2" name="language_iso_code_2" type="text" class="validate @error('language_iso_code_2') is-invalid @enderror" value="{{ $language->language_iso_code_2 }}" autocomplete="language_iso_code_2" required 
                          data-error=".errorTxt1">
                        <label for="language_iso_code_2">{{ __('Language ISO Code2') }}</label>
                        @error('language_iso_code_2')
                        <small class="red-text errorTxt1">{{ __($message) }}</small>
                        @enderror
                      </div>
                      <div class="col s12 input-field">
                        <input id="language_iso_code_3" name="language_iso_code_3" type="text" class="validate @error('language_iso_code_3') is-invalid @enderror" value="{{ $language->language_iso_code_3 }}" autocomplete="language_iso_code_3" required 
                          data-error=".errorTxt1">
                        <label for="language_iso_code_3">{{ __('Language ISO Code3') }}</label>
                        @error('language_iso_code_3')
                        <small class="red-text errorTxt1">{{ __($message) }}</small>
                        @enderror
                      </div>
                      <div class="divider mb-3"></div>
                      <div class="col s12 display-flex justify-content-end mt-3">
                        <button type="submit" class="btn indigo">{{ __('Update') }}</button>
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
                          <th>{{__('Language')}}</th>
                          <th>{{__('Language ISO Code2')}}</th>
                          <th>{{__('Language ISO Code3')}}</th>
                          <th>{{__('Action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($languageLists as $key => $languageList)
                          <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>
                                <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="purple-text">{!! $languageList->language !!}</span>
                                </span>
                                </span>
                            </td>
                            <td>
                                <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="purple-text">{!! $languageList->language_iso_code_2 !!}</span>
                                </span>
                                </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="purple-text">{!! $languageList->language_iso_code_3 !!}</span>
                                </span>
                                </span>
                              </td>
                            <td>
                              <a href="{{ route('languageList.edit',$languageList->id) }}"><i class="material-icons">edit</i></a>
                              <a onclick="deleteRow({{ $languageList->id }})"><i class="material-icons">delete</i></a>
                                <form id="delete-form-{{ $languageList->id }}" action="{{ route('languageList.destroy',$languageList->id) }}" method="POST" style="display: none;">
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
