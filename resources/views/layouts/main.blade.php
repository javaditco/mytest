<!DOCTYPE html>
<html lang="en" >
  <head>
    <title>my test</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">
    
    <link rel="stylesheet" href="{{asset('app-assets/css/bootstrap.min.css')}}">

	
  </head>
  <body>

  @yield('content')



  <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
  </body>
  </html>
