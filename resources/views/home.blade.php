@extends('layouts.app')
@section('content')
<div class="card pt-1 bg-light">
  <div class="container mt-1" v-on:click="toggle">
    <span class="activea"><h4 class="ml-2">FORUMS <a href="#" ><i class="fa fa-caret-down" style="color: #000"></i></a></h4></span>
  </div>
</div>
<div class="container">
  <div class="row">
     <div v-show="active" style="display: none;" class="p-2">
        <table class="table vertical-align mb-1" cellspacing="5" style="color: #ccc;">
          @foreach($forum_categories ?? '' as $cater)
            <tr>
              <td>
                <legend style="padding: 5px;" class="text-dark">{{$cater->name}}</legend>
                    @foreach($cater->forums as $forum)
                    {{$loop->first?'':''}}
                  <span class="focuz">
                    <a href="/forum/{{$forum->slug}}" title="{{$forum->description}}" class="btn rounded-pill mb-1 btn-xtrm" style="border: 1px solid; ">{!! $forum->name!!}</a>
                  </span>
                     @endforeach
              </td>
             </tr>
          @endforeach
        </table>
    </div>
  </div>  <!--EndOfRow -->
 </div><!-- EndOfContainer -->
 <div class="container">
  <div class="row">
  @include('threads._partials.widget')
   <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
      <div class="tab nav-tabs mb-1 bg-light">
      <button v-for="(tab, index) in tabs" :key="index" :class="{ active: selectedTab === tab}" id="tablinks" @click="selectedTab = tab"> @{{ tab }}</button>
      </div>
      <div v-show="selectedTab =='Feed'">
        @if(Auth::check())
            <user-feed></user-feed>
        @else
          <div class="" style="font-size: 15px;  line-height: 24px; margin: 0.5%; width: 100%;">
            <span><i class="font-weight-bold"> Ooops!...</i> Seems like you've not registered or loggedIn yet</span>
             <span class=""><a href="/register" class="btn btn-outline-secondary  border-secondary px-5 mr-2 rounded-pill">Register</a> or  <a href="/login" class="btn btn-primary text-light rounded-pill px-5 ">Login</a> to get started</span>
         </div>
        @endif
    </div>
     <div v-show="selectedTab == 'Featured'" class="shadow-sm">
          @if(isset($getFeatured))
                @foreach($getFeatured as $key => $featured)
                  @if(!Auth::check())
                    @if($key++ % 9 == 1)
                    <div class='heading align-center'>
                          <a href="/register" target="_blank">
                            <img src="/storage/img/advert.jpg" alt=""><br>
                          </a>
                      <a href='/register' class="text-blue">Register</a> and <a href='/login' class="text-blue">Login</a> to join our community
                    </div>
                    @endif
            @endif
            <div class="forum_title rounded">
               <a href="/u/{{$featured->user->username}}"><img class="image-circle" src="/storage/img/{{$featured->user->avatar ? $featured->user->avatar : 'default.jpg'}}"></a>
                <div class="featured">
                  @if ($featured->pinned)
                      <small class="font-weight-bold">Pinned:</small>
                    @endif
                    <a href="/{{$featured->slug}}">{{$featured->title}} </a><br>
                    <span class="c"><i class="fa fa-comment"></i>&nbsp;{{$featured->replies_count}} {{Str::plural('comment', $featured->replies_count)}}</span>&nbsp;<span class=" v mr-2 items-center text-grey-dark mr-2">&nbsp;
                        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="13" viewBox="0 0 19 13" class="d-inline">
                            <g fill="none" fill-rule="evenodd">
                                <path stroke="#C1C1CE" stroke-width="0" d="M0-3h19v19H0z"/>
                                <path fill="#C1C1CE" d="M9.5.562C5.542.562 2.161 3.025.792 6.5c1.37 3.475 4.75 5.937 8.708 5.937s7.339-2.462 8.708-5.937C16.838 3.025 13.458.562 9.5.562zm0 9.896A3.96 3.96 0 0 1 5.542 6.5 3.96 3.96 0 0 1 9.5 2.542 3.96 3.96 0 0 1 13.458 6.5 3.96 3.96 0 0 1 9.5 10.458zm0-6.333A2.372 2.372 0 0 0 7.125 6.5 2.372 2.372 0 0 0 9.5 8.875 2.372 2.372 0 0 0 11.875 6.5 2.372 2.372 0 0 0 9.5 4.125z"/>
                            </g>
                        </svg>
                    {{ $featured->visits }} visits
                </span><span class="tm">published {{$featured->created_at->diffForHumans()}}</span>
                </div>
          </div>
            @endforeach
              {!!$getFeatured->links()!!}
            @endif
    </div>
   </div>
   </div>
 </div>
@endsection
