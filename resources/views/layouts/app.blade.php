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
<link rel="icon" href="{{('flav.png')}}">
<link href="{{url('css/font-awesome.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('css/xf.css')}}">
<link rel="stylesheet" href="{{url('css/app.css')}}">
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
         <nav class="navbar navbar-static-top navbar-expand-sm x-c p-1">
            <a class="navbar-brand" href="/"><img  class="navbar-brand" src="/storage/img/logo.png" width="150" height="35" class="logo"></a>
                <button class="navbar-toggler" type="button text-light" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" ><i class="fa fa-bars text-light"></i></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-light" href="/xf/forums">Forum</a>
                    </li>

                    @if(Auth::check())
                        @include('layouts.nav')
                    @else
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light" href="/register">Register</a>
                    </li>
                    @endif
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <div class="input-group input-group-sm col-md-12">
                        <input type="text" class="form-control"  name="q" placeholder="Search xtreemforum..."   aria-describedby="button-addon1"/>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="submit" id="button-addon1" style="background-color:inherit;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                    </div>
                </form>

            </div>
        </nav>


        @yield('content')



    <footer class="page-footer p-1 bg-light">
    <!-- <div class="footnote d-flex justify-center">
    <ul>
    <li></li>

    </ul>

    </div> -->
         <div class="inner" style="text-align: center;"> <!--<a href="/terms" class="link m-3">Terms</a>
    <a href="/privacy" class="link m-3">Privacy</a><br> -->
            &copy; <?php echo date('Y')?> Xtreemforum.com, All rights reserved.
        </div>
    </footer>
    </div>
   </div> <!-- end of ID-APP -->
   @yield('scripts')
 <script type="text/javascript" src="{{mix('js/app.js')}}"></script>
</body>
</html>
