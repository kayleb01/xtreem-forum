<html>
<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>
<meta name="description" content="">
<meta property="og:url" content="{{url('moderation/users')}}">
<link rel="icon" href="{{asset('flav.png')}}">
<link rel="stylesheet" href="{{asset('css/core.css')}}">
<link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/skin-red-light.css')}}">
</head>
<body class="skin-red-light layout-top-nav">