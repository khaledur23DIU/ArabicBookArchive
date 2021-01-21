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

    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/vendors.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/materialize.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/login.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/custom/custom.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  </head>
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        @yield('content')
        <div class="content-overlay"></div>
      </div>
    </div>


    <script src="{{asset('assets/backend/app-assets/js/vendors.min.js')}}"></script>

    <script src="{{asset('assets/backend/app-assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/js/search.min.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/js/custom/custom-script.min.js')}}"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}

  </body>
</html>