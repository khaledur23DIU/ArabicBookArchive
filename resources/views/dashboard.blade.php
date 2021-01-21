@extends('layouts.backend.app')

@section('title', __('Dashboard'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/select.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/data-tables.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/materialize.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/style.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/style3.css')}}"> --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/style3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/custom/custom.css')}}">
@endpush

@section('content')
<div class="col s12">
          <div class="container">
            <!--Gradient Card-->
    <div id="cards-extended">
      <div class="card">
    <div class="card-content">
      <div class="row" id="gradient-Analytics">
        <div class="col s12 m6 l3 card-width">
          <div class="card row gradient-45deg-deep-orange-orange gradient-shadow white-text padding-4 mt-5">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5 mb-5">add_shopping_cart</i>
              <p>{{__('Library')}}</p>
            </div>
            <div class="col s5 m5 right-align">
              <h5 class="mb-0 white-text">{{ $libraryCount }}</h5>
              <p class="no-margin">{{__('In')}}</p>
              <p>{{__('Total')}}</p>
            </div>
          </div>
        </div>
        <div class="col s12 m6 l3 card-width">
          <div class="card row gradient-45deg-blue-indigo gradient-shadow white-text padding-4 mt-5">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5 mb-5">perm_identity</i>
              <p>{{__('Person')}}</p>
            </div>
            <div class="col s5 m5 right-align">
              <h5 class="mb-0 white-text">{{ $personCount }}</h5>
              <p class="no-margin">{{__('In')}}</p>
              <p>{{__('Total')}}</p>
            </div>
          </div>
        </div>
        <div class="col s12 m6 l3 card-width">
          <div class="card row gradient-45deg-purple-deep-orange gradient-shadow white-text padding-4 mt-5">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5 mb-5">timeline</i>
              <p>{{__('Manuscript')}}</p>
            </div>
            <div class="col s5 m5 right-align">
              <h5 class="mb-0 white-text">{{$manuscriptCount}}</h5>
              <p class="no-margin">{{__('In')}}</p>
              <p>{{__('Total')}}</p>
            </div>
          </div>
        </div>
        <div class="col s12 m6 l3 card-width">
          <div class="card row gradient-45deg-purple-deep-purple gradient-shadow white-text padding-4 mt-5">
            <div class="col s7 m7">
              <i class="material-icons background-round mt-5 mb-5">star_border</i>
              <p>{{__('Books')}}</p>
            </div>
            <div class="col s5 m5 right-align">
              <h5 class="mb-0 white-text">{{$bookBasicCount}}</h5>
              <p class="no-margin">{{__('In')}}</p>
              <p>{{__('Total')}}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

  <div class="divider mt-2"></div>

  <!-- Card With Analytics -->
    <div id="card-with-analytics" class="section">
    <h4 class="header">{{__('Latest 5 Records In Each')}}</h4>
    <div class="row">
      <div class="col s12 m6 l6 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <div class="card-content">
          <h2 class="card-title">{{__('Book Basic Info')}}</h2>
          <div class="row">
            <a href="{{ route('bookBasicInfo.index') }}" class="btn waves-effect gradient-45deg-purple-light-blue">{{__('All Records')}}</a>
            <div class="col s12">
            <table class="display">
              <thead>
                <tr>
                  <th><span class="purple-text"><i class="material-icons">star_border</i></span></th>
                  <th><span class="purple-text">{{__('Book')}}</span></th>
                  <th><span class="purple-text">{{__('Language')}}</span></th>
                  <th><span class="purple-text">{{__('Author')}}</span></th>
                  <th><span class="purple-text">{{__('Created At')}}</span></th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($bookBasicInfo))
                @foreach ($bookBasicInfo as $info)
                <tr>
                  <td><i class="material-icons">star_border</i></td>
                  <td>
                    @if (!empty($info->book->bookName))
                    <a href="{{ route('bookBasicInfo.show',$info->book->book_basic_info->id) }}"><span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{$info->book->bookName}}</span></span>
                      </span></a>
                    @else
                      <span class="chip purple lighten-5">
                        <span class="red-text"><span class="red-text">{{__('NA')}}</span></span>
                      </span>
                    @endif
                  </td>
                  <td>
                    @if (!empty($info->language->language))
                      <span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{!! $info->language->language !!}</span></span>
                      </span>
                      @else
                      <span class="chip purple lighten-5">
                        <span class="red-text"><span class="red-text">{{__('NA')}}</span></span>
                      </span>
                    @endif
                  </td>
                  <td>
                    @if (!empty($info->book->person_book->person_list_bookable->personName))
                      <span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{$info->book->person_book->person_list_bookable->personName}}</span>
                      </span>
                      </span>
                      @else
                      <span class="chip purple lighten-5">
                        <span class="red-text"><span class="red-text">{{__('NA')}}</span></span>
                      </span>
                    @endif
                  </td>
                  <td>
                    @if (!empty($info->created_at))
                    <span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{$info->created_at->toFormattedDateString()}}</span></span>
                      </span>
                      @else
                      <span class="chip purple lighten-5">
                        <span class="red-text"><span class="red-text">{{__('NA')}}</span></span>
                      </span>
                    @endif
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td>{{__('No Records Found!')}}</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
      </div>
      </div>

      <div class="col s12 m6 l6 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <div class="card-content">
          <h4 class="card-title">{{__('Person Info')}}</h4>
          <div class="row">
            <div class="col s12">
              <a  href="{{ route('person-info.index') }}" class="btn waves-effect gradient-45deg-purple-light-blue">{{__('All Records')}}</a>
            </div>
            <div class="col s12">
            <table class="display">
              <thead>
                <tr>
                  <th><span class="purple-text"><i class="material-icons">star_border</i></span></th>
                  <th><span class="purple-text">{{__('Name')}}</span></th>
                  <th><span class="purple-text">{{__('Surname')}}</span></th>
                  <th><span class="purple-text">{{__('Fathers Name')}}</span></th>
                  <th><span class="purple-text">{{__('Akidah Mazhab')}}</span></th>
                  <th><span class="purple-text">{{__('Fikih Mazhab')}}</span></th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($persons))
                  @foreach ($persons as $person)
                <tr>
                  <td><i class="material-icons">star_border</i></td>
                  <td>
                      <a href="{{ route('person-info.show',$person->id) }}"><span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{$person->personName}}</span></span>
                      </span></a>
                  </td>
                  <td>
                    <span class="chip purple lighten-5">
                        <span class="purple-text">@if (!empty($person->surName))
                        <span class="purple-text">{{$person->surName}}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                      </span>
                  </td>
                  <td>
                    <span class="chip purple lighten-5">
                        <span class="purple-text">@if (!empty($person->fathersName))
                        <span class="purple-text">{{$person->fathersName}}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                      </span>
                  </td>
                  <td>
                      <span class="chip purple lighten-5">
                        <span class="purple-text">@if (!empty($person->mazhabAkidah))
                        <span class="purple-text">{{$person->mazhab_akidah->mazhabName}}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                      </span>
                  </td>
                  <td>
                      <span class="chip purple lighten-5">
                        <span class="purple-text">@if (!empty($person->mazhab_fikih))
                        <span class="purple-text">{{$person->mazhab_fikih->mazhabName}}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                      </span>
                  </td>
                  
                </tr>
                @endforeach
                @else
                <tr>
                  <td>{{__('No Records Found!')}}</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
         </div>
        </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col s12 m6 l6 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <div class="card-content">
          <h2 class="card-title">{{__('Manuscript Info')}}</h2>
          <div class="row">
            <a href="{{ route('manuscriptInfo.index') }}" class="btn waves-effect gradient-45deg-purple-light-blue">{{__('All Records')}}</a>
            <div class="col s12">
            <table class="display">
              <thead>
                <tr>
                  <th><span class="purple-text"><i class="material-icons">star_border</i></span></th>
                  <th><span class="purple-text">{{__('Name')}}</span></th>
                  <th><span class="purple-text">{{__('Library')}}</span></th>
                  <th><span class="purple-text">{{__('Written Year')}}</span></th>
                  <th><span class="purple-text">{{__('Page Count')}}</span></th>
                  <th><span class="purple-text">{{__('Page Size')}}</span></th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($manuscripts))
                  @foreach ($manuscripts as $manus)
                  
                <tr>
                  <td><i class="material-icons">star_border</i></td>
                  <td>
                      <a href="{{ route('manuscriptInfo.show',$manus->id) }}"><span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{$manus->book->bookName}}</span></span>
                      </span></a>
                  </td>
                  <td>
                      <span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{ $manus->library->libraryName }}</span></span>
                      </span>
                  </td>
                  <td>
                    <span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{ $manus->writtenYearHijri }}</span></span>
                      </span>
                  </td>
                  <td>
                    <span class="chip purple lighten-5">
                        <span class="purple-text"> @if (!empty($manus->pageCount))
                         <span class="purple-text">{{ $manus->pageCount }}</span> @else <span class="red-text">{{__('NA')}}</span> @endif </span>
                      </span>
                  </td>
                  <td>
                    <span class="chip purple lighten-5">
                        <span class="purple-text"> @if (!empty($manus->pageSize))
                         <span class="purple-text">{{ $manus->pageSize }}</span> @else <span class="red-text">{{__('NA')}}</span> @endif </span>
                      </span>
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td>{{__('No Records Found!')}}</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
        </div>
      </div>
      </div>
      </div>

      <div class="col s12 m6 l6 card-width">
        <div class="card border-radius-6">
          <div class="card-content center-align">
            <div class="card-content">
          <h4 class="card-title">{{__('Library Info')}}</h4>
          <div class="row">
            <div class="col s12">
              <a href="{{ route('libraryList.index') }}" class="btn waves-effect gradient-45deg-purple-light-blue">{{__('All Records')}}</a>
            </div>
            <div class="col s12">
            <table class="display">
              <thead>
                <tr>
                  <th><span class="purple-text"><i class="material-icons">star_border</i></span></th>
                  <th><span class="purple-text">{{__('Library')}}</span></th>
                  <th><span class="purple-text">{{__('Place')}}</span></th>
                  <th><span class="purple-text">{{__('Email')}}</span></th>
                  <th><span class="purple-text">{{__('Phone')}}</span></th>
                </tr>
              </thead>
              <tbody>
                @if (!empty($libraries))
                  @foreach ($libraries as $library)
                <tr>
                  <td><i class="material-icons">star_border</i></td>
                  <td>
                      <a href="{{ route('libraryList.show',$library->id) }}"><span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{ $library->libraryName }}</span></span>
                      </span></a>
                  </td>
                  <td>
                      <span class="chip purple lighten-5">
                        <span class="purple-text"><span class="purple-text">{{ $library->place->city }}&nbsp ,{{ $library->place->country->country }}</span></span>
                      </span>
                  </td>
                  <td>
                    <span class="chip purple lighten-5">
                        <span class="purple-text"> @if (!empty($library->email))
                         <span class="purple-text">{{ $library->email }}</span> @else <span class="red-text">{{__('NA')}}</span> @endif </span>
                      </span>
                  </td>
                  <td>
                    <span class="chip purple lighten-5">
                        <span class="purple-text"> @if (!empty($library->phone))
                         <span class="purple-text">{{ $library->phone }}</span> @else <span class="red-text">{{__('NA')}}</span> @endif </span>
                      </span>
                  </td>
                </tr>
                @endforeach
                @else
                <tr>
                  <td>{{__('No Records Found!')}}</td>
                </tr>
                 @endif
              </tbody>
            </table>
          </div>
         </div>
        </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>
</div>
  
@endsection

@push('js')

  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/vendors/data-tables/js/dataTables.select.min.js')}}"></script>
  <script src="{{asset('assets/backend/app-assets/js/scripts/data-tables.min.js')}}"></script>
  <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>

@endpush
