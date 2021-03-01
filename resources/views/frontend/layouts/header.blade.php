<!DOCTYPE html>
<html lang="en">
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
<meta name="description" content="">
<meta property="og:url" content="{{url('/home')}}">

<link rel="stylesheet" href="{{asset('css/core.css')}}">
<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/xf.css')}}">
</head>
<body class="xf-theme layout-top-nav">
<div class="wrapper">
	<header class="main-header">
		<nav class="navbar navbar-static-top">
			<div class="container">
				<div class="navbar-header">
				<a href="/" class="navbar-brand"><b>Xtreem Forum</b></a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
				<i class="fa fa-bars"></i>
				</button>
				</div>

				<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
				<ul class="nav navbar-nav">
				<li>
				<a href="{{url('/')}}">Home</a>
				</li>

				<li>
				<a href="/forums">Forum</a>
				</li>
				<li class="dropdown">
					@if(Auth::user()->role == 1 || Auth::user()->role == 2)
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				Moderation
				<span class="caret"></span>
				</a>

				<ul class="dropdown-menu" role="menu">
				<li><a href="{{url('/moderation')}}">Dashboard</a>
				</li><li>
				<a href="{{url('moderation/reported')}}">Reported Posts
				<span class="badge alert-success">9</span>
				</a>
				</li>
				</ul>
				</li>
				@endif
				@if(Auth::user()->role == 1)
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
				Admin
				<span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
				<li><a href="{{url('/admin')}}">Admin Panel</a>
				</li>
				</ul>
				</li>
					@endif
				</ul>
				</div>

				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
					<!-- Menu Toggle Button -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
					<!-- The user image in the navbar-->
				<!-- 	<img src="" class="user-image" alt="User Image"> -->
					<!-- hidden-xs hides the username on small devices so only the image appears. -->
					<span class="hidden-xs">{{Auth::user()->username}}</span>
					</a>
					<ul class="dropdown-menu">
					<!-- The user image in the menu -->
					<li class="user-header">
					<p>
					<img src="/storage/storage/img/{{Auth::user()->image_url}}" class="img-circle" alt="Avatar">
					</p>
					</li>
					<!-- Menu Body -->
					<li class="user-body">
					<div class="row">
					<div class="col-xs-4 text-center">
					<a href="{{url('/')}}">Threads</a>
					</div>
					<div class="col-xs-4 text-center">
					<a href="#">Posts</a>
					</div>
					<div class="col-xs-4 text-center">
					<a href="{{url('/user/'.Auth::user()->id.'/ edit')}}">Edit Profile</a>
					</div>
					</div>
					</li>
					<!-- Menu Footer-->
					<li class="user-footer">
					<div class="pull-left">
					<a href="/user/{{Auth::user()->username}}" class="btn btn-default">View Profile</a>
					</div>
					<div class="pull-right">
					<a href="/logout" class="btn btn-default">Logout</a>
					</div>
					</li>
					</ul>
					</li>
				</ul>
				</div>

			</div>
		</nav>
	</header>