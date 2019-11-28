@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="/">Home</a></li>
            <li>{{($user_data->username)}} &sdot;</li>
        </ol>
      <div class="col-md-3 col-lg-3 col-sm-12 col-xs-12"><br>
       
        <div class="panel user-data-widget"> <br>
          <img src="/storage/storage/img/{{$user_data->avatar?$user_data->avatar:'default.png'}}" class="profile-image" style="margin-left:80px; padding:0px;"><br><br><br><br><br>
          <ul class="list-group widget2">
            <li style="color: #000" class="list-group-item">Username: {{ucwords($user_data->username)}}</li>
            <li style="color: #000" class="list-group-item">Joined:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$user_data->created_at->diffForHumans()}}</li>
            <li class="list-group-item"><a href="#"> {{ucwords($user_data->username)}}'s Threads</a></li>
            <li class="list-group-item"><a href="#"> {{ucwords($user_data->username)}}'s Comments</a></li>
            <li class="list-group-item"><a href="/profiles/{{$user_data->username}}/activity"> {{ucwords($user_data->username)}}'s Profile</a></li>
          </ul>
        </div>
      </div>
        <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
            {!!$threads->links()!!}
            @if($threads->count() > 0)
                @foreach($threads as $thread)
                      <div class="panel-body" style="padding:6px; border: none;">
                          <span class="title">
                                    <!-- The thread section -->
                            &nbsp;&nbsp;<a href="/xf/{{$thread->slug}}"  style="padding-left: 0px !important">{{$thread->title}}</a>
                          </span>
                            <span class="details">
                                        <!-- Print out the User details -->
                                     <span class="tm"><i class="fa fa-comment"></i>&nbsp;{{$thread->replies_count}} {{Str::plural('comment', $thread->replies_count)}}</span>&nbsp;&nbsp;<span class="v">&nbsp;{{$thread->visits}} {{Str::plural('view', $thread->visits)}}</span>&nbsp;&nbsp;<span class="tm">published on {{$thread->created_at->diffForHumans()}}</span>                      
                            </span>
                        </div>
                 @endforeach
                 {!!$threads->links()!!}
                      </div>
             
        @else
        
          <span class="lead">No Activity Recorded yet</span>
        </div>
        @endif
        <!-- widget -->
        @include('threads._partials.widget')
        </div> <!-- End Row  --> 
</div> 
</div>
@endsection
