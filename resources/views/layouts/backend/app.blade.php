<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>{{ config('app.name', 'Archive') }} | @yield('title')</title>
    <link rel="apple-touch-icon" href="{{asset('assets/backend/app-assets/images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/backend/app-assets/images/favicon/favicon-32x32.png')}}">
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/vendors.min.css')}}">
    
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/materialize.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/style.min.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/style3.css')}}"> --}}
    
    <!-- END: Page Level CSS-->
    
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style3.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/custom/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{asset('assets/backend/src/css/bootstrap-datetimepicker.css')}}" rel="stylesheet" />
    <!-- END: Custom CSS-->
    @stack('css')
</head>
  <!-- END: Head-->
    <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    @include('layouts.backend.partials.header')
    <!-- END: Header-->
    



    <!-- BEGIN: SideNav-->
    @include('layouts.backend.partials.left-sidebar')
    <!-- END: SideNav-->

    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          @if (!Request::routeIs('dashboard'))
            <div class="container">
            <div class="row">
              <div class="col s12 m12 right-align">
                <h5 class="breadcrumbs-title mt-0 mb-0"><span>@yield('title')</span></h5>
                <ol class="breadcrumbs mb-0">
                  <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{__('Dashboard')}}</a>
                  </li>
                  <li class="breadcrumb-item"><a href="{{ url()->previous() }}">{{__('Pages')}}</a>
                  </li>
                  <li class="breadcrumb-item active">@yield('title')
                  </li>
                </ol>
              </div>
            </div>
          </div>
          @endif
          
        </div>
        <div class="col s12">
          <div class="container">

            @yield('content')
            
          </div>
          <div class="content-overlay"></div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->
  
    <!-- BEGIN: Footer-->

    @include('layouts.backend.partials.footer')

    <!-- END: Footer-->
    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('assets/backend/app-assets/js/vendors.min.js')}}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN THEME  JS-->
    <script src="{{asset('assets/backend/app-assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/js/search.min.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/js/custom/custom-script.min.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/js/scripts/customizer.min.js')}}"></script>
    <!-- END THEME  JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    
    <!-- END PAGE LEVEL JS-->
    @stack('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script src="{{asset('assets/backend/src/js/momentjs.js')}}"></script>
    <script src="{{asset('assets/backend/src/js/moment-with-locales.js')}}"></script>
    <script src="{{asset('assets/backend/src/js/moment-hijri.js')}}"></script>
    <script src="{{asset('assets/backend/src/js/bootstrap-hijri-datetimepicker.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('.tooltipped').tooltip();
      });
    </script>
  </body>

</html>