@extends('layouts.backend.app')

@section('title', __('Book Category'))

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
                    <form action="{{ route('bookCategory.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="col s12 input-field">
                        <input id="bookCategory" name="bookCategory" type="text" class="validate @error('bookCategory') is-invalid @enderror" value="{{ old('bookCategory') }}" autocomplete="bookCategory" required 
                          data-error=".errorTxt1">
                        <label for="bookCategory">{{ __('Book Category') }}</label>
                        @error('bookCategory')
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
                          <th>{{__('Book Category')}}</th>
                          <th>{{__('Created At')}}</th>
                          <th>{{__('Action')}}</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($bookCategories as $key => $bookCategory)
                          <tr>
                            <td>{!! $key+1 !!}</td>
                            <td>
                                <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="purple-text">{!! $bookCategory->bookCategory !!}</span>
                                </span>
                                </span>
                            </td>
                            <td>
                              <span class="chip purple lighten-5">
                                <span class="purple-text"><span class="purple-text">{!! $bookCategory->created_at->toFormattedDateString() !!}</span>
                                </span>
                                </span>
                            </td>
                            <td>
                              <a href="{{ route('bookCategory.edit',$bookCategory->id) }}"><i class="material-icons">edit</i></a>
                              <a onclick="deleteRow({{ $bookCategory->id }})"><i class="material-icons">delete</i></a>
                                <form id="delete-form-{{ $bookCategory->id }}" action="{{ route('bookCategory.destroy',$bookCategory->id) }}" method="POST" style="display: none;">
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
