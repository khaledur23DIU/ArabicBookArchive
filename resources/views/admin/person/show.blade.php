@extends('layouts.backend.app')

@section('title', __('Person Info'))

@push('css')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/data-tables/css/select.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/data-tables.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-users.min.css')}}">
@endpush

@section('content')
<div class="col s12">
  <div class="container">
    <section class="users-list-wrapper section">
       <div class="section users-view">
      

  <div class="card">
    <div class="card-content">
      <div class="row indigo lighten-5 border-radius-4 mb-2">
        <div class="col s12 m4 users-view-timeline">
          <h6 class="indigo-text m-0">{{__('Name')}}: <span>{{$person->personName}}</span>
            <a class="btn gradient-45deg-purple-light-blue" href="{{ route('person-info.edit',$person->id) }}"><i class="material-icons">edit</i>{{__('Edit')}}</a>
          </h6>
              
        </div>
        
      </div>
      <div class="row">
        <div class="col s12">
          <table class="striped">
            <tbody>
              
              <tr>
                <td>{{__('Surname')}}:</td>
                <td>
                  @if (!empty($person->surName))
                  
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="green-text">{{$person->surName}}</span></span>
                    </span>
                    
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
              <tr>
                <td>{{__('Fathers Name')}}:</td>
                <td>
                  @if (!empty($person->fathersName))
                  
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="green-text">{{$person->fathersName}}</span></span>
                    </span>
                    
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>
              <tr>
                @if (count($person->person_categories))
                <td>{{__('Person Categories')}}:</td>
                <td>
                  @foreach ($person->person_categories as $category)
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="green-text">{{__($category->person_category)}}</span></span>
                    </span>
                    @endforeach
                </td>
                @else
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                @endif
              </tr>
              <tr>
                <td>{{__('Birth Info')}}:</td>
                <td>
                  @if (!empty($person->birthYearHijri))
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp<span class="green-text">{{$person->birthYearHijri}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif

                    @if (!empty($person->birthYearIsae))
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp<span class="green-text">{{$person->birthYearIsae}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif

                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Country')}}:&nbsp @if (!empty($person->birthPlaceID))
                       <span class="green-text">{{$person->birthPlace->country->country}}</span>@else <span class="red-text">{{__('NA')}}</span>@endif </span>
                       <span class="purple-text">{{__('City')}}:&nbsp @if (!empty($person->birthPlaceID))
                       <span class="green-text">{{$person->birthPlace->city}}</span>@else <span class="red-text">{{__('NA')}}</span>@endif </span>
                    </span>
                </td>
              </tr>
              <tr>
                <td>{{__('Death Info')}}:</td>
                <td>
                  @if (!empty($person->deathYearHijri))
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp<span class="green-text">{{$person->deathYearHijri}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif

                    @if (!empty($person->deathYearHijri))
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp<span class="green-text">{{$person->deathYearHijri}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Isae')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif

                    
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Country')}}:&nbsp @if (!empty($person->deathPlaceID))
                       <span class="green-text">{{$person->deathPlace->country->country}}</span>@else <span class="red-text">{{__('NA')}}</span>@endif</span>
                       <span class="purple-text">{{__('City')}}:&nbsp @if (!empty($person->deathPlaceID))
                       <span class="green-text">{{$person->deathPlace->city}}</span>@else <span class="red-text">{{__('NA')}}</span>@endif </span>
                    </span>
                    
                </td>
              </tr>
                
              <tr>
                @if (count($person->person_residences)!=0)
                @foreach ($person->person_residences as $residence)
                <td>{{__('Residence Info')}}:</td>
                <td>
                  
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Hijri')}}:&nbsp 
                        @if (!empty($residence->reStartYearHijri))
                        <span class="green-text">{{$residence->reStartYearHijri}}</span>
                        @else<span class="red-text">{{__('NA')}}</span>
                        @endif
                        &nbsp-&nbsp 
                        @if (!empty($residence->reStartYearHijri))
                        <span class="green-text">{{$residence->reStartYearHijri}}</span>
                        @else<span class="red-text">{{__('NA')}}</span>
                        @endif</span>
                    </span>
                                        
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Country')}}:&nbsp @if (!empty($residence->residencePlaceID))
                       <span class="green-text">{{$residence->residence_place->country->country}}</span>@else<span class="red-text">{{__('NA')}}</span>@endif</span>
                       <span class="purple-text">{{__('City')}}:&nbsp @if (!empty($residence->residencePlaceID))
                       <span class="green-text">{{$residence->residence_place->city}}</span>@else<span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                    
                </td>
                @endforeach
                @else 
                <td>{{__('Residence Info')}}:</td>
                <td>
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                </td>
                @endif
              </tr>
              
              <tr>
                <td>{{__('Kuniad')}}:</td>
                <td>
                  @if (!empty($person->kuniad))
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Name of Kuniad')}}:&nbsp<span class="green-text">{{$person->kuniad}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Name of Kuniad')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>

              <tr>
                <td>{{__('Popularity')}}:</td>
                <td>
                  @if (!empty($person->popularity))
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Person Popularity')}}:&nbsp<span class="green-text">{{$person->popularity}}</span></span>
                    </span>
                    @else
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Person Popularity')}}:&nbsp<span class="red-text">{{__('NA')}}</span></span>
                    </span>
                    @endif
                </td>
              </tr>

              <tr>
                <td>{{__('Mazhab')}}:</td>
                <td>
                  
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Mazhab Fikih')}}:&nbsp @if (!empty($person->mazhabFikih))<span class="green-text">{{$person->mazhab_fikih->mazhabName}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                    <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Mazhab Akidah')}}:&nbsp @if (!empty($person->mazhabAkidah))<span class="green-text">{{$person->mazhab_akidah->mazhabName}}</span> @else <span class="red-text">{{__('NA')}}</span>@endif</span>
                    </span>
                    
                </td>
              </tr>

            </tbody>
          </table>

          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('Person Books')}} </h6>
          <table class="striped">
            <tbody>
              <tr>
                @if (count($person->person_list_books)!=0)
                  
                
                <td>{{__('Books')}}:</td>
                <td>
                  @foreach ($person->person_list_books as $key=> $book)
                      <a href="{{ route('bookBasicInfo.show',$book->book->book_basic_info->id) }}"><span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Name')}}:&nbsp<span class="green-text">{{$book->book->bookName}}</span></span>
                      </span>
                      </a>
                  @endforeach
                </td>
                @else
                <td>{{__('Books')}}:</td>
                <td>
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                </td>
                @endif
              </tr>
            </tbody>
          </table>
          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('Links')}} </h6>
          <table class="striped">
            <tbody>
              @if (count($person->person_followers)!=0)
              
              <tr>
                <td>{{__('Followers')}}:</td>
                <td>
                     @foreach ($person->person_followers as $follower)
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Name')}}:&nbsp<span class="green-text">{{$follower->personName}}</span></span>
                    </span>
                       @endforeach
                </td>
              </tr>
              
              @else
              <tr>
                <td>{{__('Followers')}}:</td>
                <td>
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                </td>
              </tr>
              @endif

              @if (count($person->person_mentors)!=0)
              
              <tr>
                <td>{{__('Mentors')}}:</td>
                <td>
                     @foreach ($person->person_mentors as $mentor)
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Name')}}:&nbsp<span class="green-text">{{$mentor->personName}}</span></span>
                    </span>
                       @endforeach
                </td>
              </tr>
              
              @else
              <tr>
                <td>{{__('Mentors')}}:</td>
                <td>
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                </td>
              </tr>
              @endif

              @if (count($person->person_students)!=0)
              
              <tr>
                <td>{{__('Inspired Whom')}}:</td>
                <td>
                     @foreach ($person->person_students as $student)
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Name')}}:&nbsp<span class="green-text">{{$student->personName}}</span></span>
                    </span>
                       @endforeach
                </td>
              </tr>
              
              @else
              <tr>
                <td>{{__('Inspired Whom')}}:</td>
                <td>
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                </td>
              </tr>
              @endif

              @if (count($person->person_teachers)!=0)
              
              <tr>
                <td>{{__('Inspired By')}}:</td>
                <td>
                     @foreach ($person->person_teachers as $teacher)
                  <span class="chip purple lighten-5">
                       <span class="purple-text">{{__('Name')}}:&nbsp<span class="green-text">{{$teacher->personName}}</span></span>
                    </span>
                       @endforeach
                </td>
              </tr>
              
              @else
              <tr>
                <td>{{__('Inspired By')}}:</td>
                <td>
                  <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                </td>
              </tr>
              @endif
              
            </tbody>
          </table>
        

          <h6 class="mb-2 mt-2"><i class="material-icons">link</i> {{__('Quotations Line')}} </h6>
          <table class="striped">
            <tbody>
                @if (count($person->person_quotations)!=0)
                @foreach ($person->person_quotations as $key=> $quotation)
              <tr>
                  
                <td>{{__('Quotation')}}-{{$key}}:</td>
                <td>
                    {{$quotation->quotation}}
                </td>
              </tr>
                @endforeach
                @else
              <tr>
                <td>{{__('Quotation')}}:</td>
                <td>
                    <span class="chip purple lighten-5">
                       <span class="purple-text"><span class="red-text">{{__('NA')}}</span></span>
                    </span>
                </td>
              </tr>
                @endif
            </tbody>
          </table>   


        </div>
      </div>
      <!-- </div> -->
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
@endpush
