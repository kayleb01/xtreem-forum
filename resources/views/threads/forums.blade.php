@extends('layouts.app')
@section('content')
<div class="conntainer">
<div class="col-md-10 col-lg-10 col-xs-12 col-sm-12">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div>
                     <ol class="breadcrumb shadow-sm" style="margin-bottom:6px !important">
                       <li class="breadcrumb-item"><a href="/">Home</a></li>
                       <li class="breadcrumb-item"><a href="#">{{$forum->name}}</a></li>
                       
                    </ol>
                    </ol>
                </div> 
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="padding: 0">
                        @foreach($errors as $category)
                        <div class="panel-body" style="padding:6px; border: none;">
                        <b> {{$category->name}}</b> <br/>
                            @foreach($category->forums as $forum)
                            <a href="/forum/{{$forum->slug}}" class="btn btn-flat ">{{$forum->name}}</a>
                            <span>({{$forum->description}})</span> Has ({{$forum->thread->count()}}) Threads and ({{$forum->comment->count()}}) Comments
                            <br>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
              </div>
             </div>     
             </div>  
                   
        </div>
        @if(Auth::check()) 
    <div class="container">
      <div class="col-md-3 col-lg-3 hidden-sm hidden-xs">
        <div class="panel-heading userprof">
        </div>
          <div class="panel-body">
            <center >
                <img src="/storage/storage/img/{{Auth::user()->image_url}}" class="image-circle" style="margin-left:100px; padding:0px;"><br><br>
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
                    <ul>
                    <li class="user-footer">
                    <div class="pull-left">
                    <a href="/user/{{Auth::user()->username}}" class="btn btn-default">View Profile</a>
                    </div>
                    <div class="pull-right">
                    <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>
                    </div>
                    </li>
                    </ul>
                    </li>
                </ul>
            </center>      
          </div> 
      </div>
    </div>
    @endif                 
    </div>  
</div>

@endsection
