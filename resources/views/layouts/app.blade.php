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

<script src="{{url('js/Popper.js')}}" type="text/javascript"></script>

 <script src="{{url('js/jquery-2.2.3.js')}}" type="text/javascript"></script>
 <script src="{{url('js/bootstrap.min.js')}}" type="text/javascript"></script>

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
<body class="xf-theme layout-top-nav" style="margin:0px !important;">
<noscript>
      <div style="font-size: 18px;  line-height: 24px; margin: 10%; width: 80%;">
        <p>We've detected that JavaScript is disabled in your browser, 80% of the content of this Site is powered by javascript. Please go to your browser's Settings and enable Javascript to enjoy the full functionality of this site. </p>
      </div>
  </noscript>
<div id="app">
    <div class="wrapper">
         <nav class="navbar sticky-top navbar-expand-sm x-c">
            <a class="navbar-brand text-light" href="/">XtreemForum</a>
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

         

    <div class="page-footer p-3">
        <div class="inner" style="text-align: center;">
            &copy; <?php echo date('Y')?> XtreemForum.com
        </div>
    </div>
    </div>
   </div> <!-- end of ID-APP -->
 <script type="text/javascript" src="{{url('js/app.js')}}"></script> 
</body>
</html>