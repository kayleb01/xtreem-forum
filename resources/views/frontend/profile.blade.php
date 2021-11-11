@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row ">
        <div class="col-md-12 col-xs-12 col-lg-12 bg-img">

        <div class=" mt-2">
            <img src="{{$data->avatar ? $data->avatar : 'default.jpg' }}" class="user-image img-fluid" />
        </div>
            <div class="user-details">
              <div class="mt-3 text-light">
                <span class="float-right mt-2 headeru" >

                  @if(Auth::check() && $data->username === Auth::user()->username)
                    <a href="/user/{{$data->username}}/edit"><button class="btn btn-primary rounded-pill">Edit Profile</button> </a>
                  @elseif(Auth::check() && $data->username !== Auth::user()->username)

                   <follow :userfollow='@json($data->id)' :active="{{json_encode($data->following)}}"></follow>
                   @else

                  @endif
                </span>
                    <h1 class="heading">{{$data->username}}</h1>
                    @if($data->role === 1)
                      <h6>Admin</h6>
                    @elseif($data->role === 2)
                      <h6>Moderator</h6>
                    @else
                    <h6>Member</h6>
                    @endif
                  <div class=" d-flex">
                    <span>
                        <i class="fa fa-clock-o"></i> Joined  {{$data->created_at->diffForHumans()}} &nbsp;
                        @if($data->dob)
                          <i class="fa fa-calendar-o"></i> {{ date($data->dob->format('d m') )}} &nbsp;
                        @endif
                        <i class="fa fa-map-marker"> </i> {{$data->location}}</span>&nbsp;

                  </div>
                        @if($data->bio)
                        <div style="width: 70%;">
                        <span>{{$data->bio}}</span>

                        </div>
                        @endif
            </div>
          </div>
           </div>
            <div class="tab nav-tabs bg-light">
            <button v-for="(tabs, index) in tab" :key="index" :class="{active: select == tabs}" id="tablinks" @click="select = tabs"> @{{ tabs }}</button>
              <!-- <button id="tablinks"> Comments  </button>
              <button id="tablinks">Threads <span class="badge badge-dark">{{$data->thread->count()}}</span></button> -->
            </div>

        </div>
        <div class="panel" v-show="select == 'Threads'">
        <span class="card card-body bg-light mb-1">
          @if($threads)
            @foreach($threads as $thread)
              <span class="card card-body mb-1 font-weight-bold bg-light"><a href="/{{$thread->slug}}">{{$thread->title}}</a>
               <span class="text-muted small"> Published {{$thread->created_at->diffForHumans()}} &nbsp;&nbsp;&nbsp;{{$thread->replies_count}}  replies</span>
              </span>

            @endforeach
             <span>{{$threads->links()}}</span>
          @else
            <h4>No Activity yet!</h4>
          @endif
          </span>
        </div>
        <div class="panel" v-show="select === 'Comments'">
              <span class="card card-body bg-light mb-1">
              @if($reply)
                @foreach($reply as $comment)
                  <div class="card card-body mb-1 font-weight-bold bg-light" style="border-bottom:1px solid #ccc"><a href="/{{$comment->thread->slug}}">RE: {{$comment->thread->title}}</a>
                  <div class="font-weight-normal p-2">
                  {!!$comment->body!!}
                  </div>
                  <span class="text-muted mt-2 small" style="border-top:1px solid #ccc"> Published {{$comment->created_at->diffForHumans()}}&nbsp;&nbsp;&nbsp;<i class="fa fa-heart-o">  {{$comment->likess->count() >= 1 ? $comment->likess->count() : ''}}</i> </span>
                  </div>

                @endforeach
                <span>{{$reply->links()}}</span>
            @else
            <h4>No Activity yet!</h4>
          @endif
            <h4>No Activity yet!</h4>
        </div>
    </div>

</div>



@endsection
