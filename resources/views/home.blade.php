  @extends('layouts.app')

@section('content')

<div class="card pt-1 ">
  <div class="container mt-1" v-on:click="toggle">
    <span class="activea"><h4>FORUMS <a href="#" ><i class="fa fa-caret-down" style="color: #000"></i></a></h4></span>
  </div>
</div>
<div class="container">
  <div class="row"> 
     <div v-show="active" style="display: none;"> 
        <table class="table vertical-align mb-1" cellspacing="5" style="color: #ccc;">
          @foreach($Categories ?? '' as $cater)
            <tr>
              <td>
                <legend style="padding: 5px;" class="text-dark">{{$cater->name}}</legend>
                    @foreach($cater->forums as $forum)
                    {{$loop->first?'':''}}
                  <span class="focuz">
                    <a href="/forum/{{$forum->slug}}" title="{{$forum->description}}" class="btn btn-outline-secondary mb-1 btn-xtrm" style="">{!! $forum->name!!}</a> 
                  </span>
                     @endforeach
              </td>
             </tr>
          @endforeach    
        </table>    
    </div>

  </div>  <!--EndOfRow -->                 
 </div> <!--EndOfContainer -->
 <div class="container">
  <div class="row">
   <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="tab nav-tabs mb-1">
      <button v-for="(tab, index) in tabs" :key="index" :class="{ active: selectedTab === tab}" id="tablinks"
    @click="selectedTab = tab"> @{{ tab }}</button>
        
      </div>
      <div v-show="selectedTab == 'Featured'" class="shadow-sm">
          @if(isset($getFeatured))
                @foreach($getFeatured as $key => $featured)
            @if(!Auth::check())  
               @if($key++ % 9 == 1)
                 <div class='heading pt-0' style='text-align: center;'> <a href='/register'>Register</a> and <a href='/login'>Login</a> to join our community</div>
               @endif
            @endif
            <div class="forum_title">
                <img class="image-circle" src="/storage/storage/img/{{$featured->user->avatar ? $featured->user->avatar : 'default.jpg'}}">
                <div class="featured">
                    <a href="/{{$featured->slug}}">{{$featured->title}} </a><br>
                    <span class="c"><i class="fa fa-comment"></i>&nbsp;{{$featured->replies_count}} {{Str::plural('comment', $featured->replies_count)}}</span>&nbsp;&nbsp;<span class="v">&nbsp;{{$featured->visits}} {{Str::plural('view', $featured->visits)}}</span>&nbsp;&nbsp;<span class="tm">published {{$featured->created_at->diffForHumans()}}</span>
                </div>
          </div>
            @endforeach
              {!!$getFeatured->links()!!}
            @endif
    </div>
    <div v-show="selectedTab == 'Trending'">
     @if(!empty($trending))
         @foreach($trending as $trend)
        <div class="forum_trend">
          <div class="featured">
           <a href="{{$trend->path}}">
             {{$trend->title}}
           </a>
           <span class="tm">Posted by {{$trend->creator}} In <a href="/forum/{{$trend->forum}}">{{$trend->forum}}</a> </span>
         </div>
        </div>
       @endforeach
      @endif
    </div>
   </div>
   <div class="col-lg-3 col-md-3 ">
     @if(Auth::check()) 
          <div class="panel-heading p-2 font-weight-bold">User Profile
            </div>
              <div class="panel-body">
                <center class="col-offset-04">
                    <img src="/storage/storage/img/{{Auth::user()->avatar}}" class="image-circle" style="margin-left:100px; padding:0px;"><br><br>
                      <ul class="list-group widget2">
                        <li class="list-group-item"><a class="" href="{{url('/user/'.Auth::user()->username.'/edit')}}">Edit Profile</a></li>
                        <li class="list-group-item"><a href="/user/{{Auth::user()->username}}" class="">View Profile</a></li>
                        <li class="list-group-item"><a href="{{url('/user/threads/'.Auth::user()->username.'')}}">Threads</a></li>
                        <li class="list-group-item"><a href="#">Comments</a></li>
                        <li class="list-group-item"><a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();" class="">Logout
                          </a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                          </form>
                        </li>
                      </ul>
                </center>      
              </div> 
            @endif  
   </div>
  </div>
 </div>
 

@endsection
