<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Web Bus</title>

    

  <link rel="icon" href="{{ asset('/favicon.ico')}}" type="image/x-icon">



      <!-- NEPALI CALENDAR LINKS -->
    <link href="{{ asset('/assets/css/nepali.datepicker.v3.min.css') }}" rel="stylesheet" type="text/css"/>
   
     <!-- MDB icon -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
  <!-- Material Design Bootstrap -->
  <link rel="stylesheet" href="{{ asset('/assets/css/mdb.min.css') }}">

  
    <!-- Styles -->
    <link href="{{ asset('/assets/css/custom-style.css') }}" rel="stylesheet">
</head>
<body>

        
        