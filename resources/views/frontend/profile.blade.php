@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row ">
        <div class="col-md-12 col-xs-12 col-lg-12 bg-img">
        
        <div class=" mt-2">
            <img src="/storage/storage/img/{{$user_data->avatar}}" class="user-image img-fluid" /> 
        </div>
            <div class="user-details">
              <div class="mt-3 text-light">
                <span class="float-right mt-2 headeru" >
               
                  @if(Auth::check() && $user_data->username === Auth::user()->username)
                    <a href="/user/{{$user_data->username}}/edit"><button class="btn btn-primary rounded-pill">Edit Profile</button> </a>
                  @elseif(Auth::check() && $user_data->username !== Auth::user()->username)
                   <follow :userfollow='@json($user_data->id)' :active="{{json_encode($user_data->isFollowed)}}"></follow> 
                   @else

                  @endif
                </span>
                    <h1 class="heading">{{$user_data->username}}</h1>
                    @if($user_data->role === 1)
                      <h6>Admin</h6>
                    @elseif($user_data->role === 2)
                      <h6>Moderator</h6>
                    @else
                    <h6>Member</h6>
                    @endif
                  <div class=" d-flex">
                    <span>
                        <i class="fa fa-clock-o"></i> Joined  {{$user_data->created_at->diffForHumans()}} &nbsp;
                        @if($user_data->dob)
                          <i class="fa fa-calendar-o"></i> {{ date($user_data->dob->format('d m') )}} &nbsp;
                        @endif
                        <i class="fa fa-map-marker"> </i> {{$user_data->location}}</span>&nbsp;

                  </div>
                        @if($user_data->bio)
                        <div style="width: 70%;">
                        <span>{{$user_data->bio}}</span>
                          
                        </div>
                        @endif
                  
                  
            </div>
          </div>
   
          
           </div>
            
            <div class="tab nav-tabs">
            <button v-for="(tabs, index) in tab" :key="index" :class="{active: select === tabs}" id="tablinks"
    @click="select = tabs"> @{{ tabs }}</button>
              <!-- <button id="tablinks"> Comments  </button>
              <button id="tablinks">Threads <span class="badge badge-dark">{{$user_data->thread->count()}}</span></button> -->
            </div>  
            
        </div>
        <div class="panel" v-show="select == 'Threads'">
          @if($threads)
            @foreach($threads as $thread)
              <span class="card card-body mb-1 font-weight-bold"><a href="/{{$thread->slug}}">{{$thread->title}}</a>
               <span class="text-muted small"> Published {{$thread->created_at->diffForHumans()}} &nbsp;&nbsp;&nbsp;{{$thread->replies_count}} replies</span>
              </span>
            
            @endforeach
             <span>{{$threads->links()}}</span>
          @else
            <h4>No Activity yet!</h4>
          @endif
        </div>
        <div class="panel" v-show="select === 'Comments'">
              <span class="card card-body mb-1">
             
            <h4>No Activity yet!</h4>
        </div>
    </div>   
    
</div>
        
         
  
@endsection
