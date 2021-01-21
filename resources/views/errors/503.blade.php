<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="author" content="ThemeSelect">
    <title>{{ config('app.name', 'Archive') }} | {{__('Service Maintainance')}} </title>
    <link rel="apple-touch-icon" href="{{asset('assets/backend/app-assets/images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/backend/app-assets/images/favicon/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/vendors/vendors.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/materialize.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/themes/vertical-modern-menu-template/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/pages/page-404.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/backend/app-assets/css/custom/custom.css')}}">

  </head>

  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column  bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container">
            <div class="section section-404 p-0 m-0 height-100vh">
            <div class="row">

            <div class="col s12 center-align white">
            <img src="{{asset('assets/backend/app-assets/images/gallery/maintenance.png')}}" class="bg-image-404" alt="">
                <h1 class="error-code m-0">503</h1>
                <h4 class="error-code">{{__('This Site is under maintenance')}}</h4>
                    <h6 class="mb-2 mt-2">{{__('We are sorry for the inconvenience.')}} <br> {{__('Please check back later.')}}</h6>
                
            </div>
            </div>
            </div>
        </div>
        <div class="content-overlay"></div>
      </div>
    </div>
    <script src="{{asset('assets/backend/app-assets/js/vendors.min.js')}}"></script>

    <script src="{{asset('assets/backend/app-assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/js/search.min.js')}}"></script>
    <script src="{{asset('assets/backend/app-assets/js/custom/custom-script.min.js')}}"></script>

  </body>

</html>