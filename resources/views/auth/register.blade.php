<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
 <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<head>
<title>{{$title ?? ''}}</title>
<meta name="description" content="">
<meta property="og:url" content="{{url('/home')}}">
<meta name="descripion" content="Entertainment, Nigerian forum, sports, gist, celebrity news, politics, general forum">
<meta name="author" content="Caleb Bala for Xtreem Technologies">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="icon" href="{{url('flav.png')}}">
<link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('css/xf.css')}}">
<link rel="stylesheet" href="{{url('css/app.css')}}">
<link href="{{asset('css/swiper.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('css/core.css')}}">

<!-- <script src="{{url('js/Popper.js')}}" type="text/javascript"></script> -->
    <!-- Scripts -->
    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>
    @yield('head')
</head>
<body class="xf-theme layout-top-nav">
<noscript>
      <div style="font-size: 18px;  line-height: 24px; margin: 10%; width: 80%;">
        <p>We've detected that JavaScript is disabled in your browser, 80% of the content of this Site is powered by javascript. Please go to your browser's Settings and enable Javascript to enjoy the full functionality of this site. </p>
      </div>
  </noscript>
  <div id="app">
    <div class="wrapper">
        <center class="mb-3">
             <a href="/"><img  class="" src="/storage/img/logo.png" width="200" height="60" class="logo"></a>
        </center>

    <register></register>

    @yield('scripts')
    </div>
  </div>
<script type="text/javascript" src="{{mix('js/app.js')}}"></script>
   <!-- swiper js -->
   <script src="{{asset('js/swiper.min.js')}}"></script>
</body>
</html>
