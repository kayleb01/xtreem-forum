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
          @foreach($Categories ?? '' as $cater)
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
      <button v-for="(tab, index) in tabs" :key="index" :class="{ active: selectedTab === tab}" id="tablinks"
    @click="selectedTab = tab"> @{{ tab }}</button>
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
                      <div class='heading pt-0' style='text-align: center;'>
                          <a href="/register" target="_blank">
                            <img src="/storage/img/advert.jpg" alt=""><br>
                          </a>
                      <a href='/register' class="text-blue">Register</a> and <a href='/login' class="text-blue">Login</a> to join our community</div>
                    @endif
            @endif
            <div class="forum_title rounded">
               <a href="/u/{{$featured->user->username}}"><img class="image-circle" src="/storage/img/{{$featured->user->avatar ? $featured->user->avatar : 'default.jpg'}}"></a>
                <div class="featured">
                  @if ($featured->pinned)
                      <small class="font-weight-bold">Pinned:</small>
                    @endif
                    <div class="d-none d-sm-block">
                    <button class="btn d-none d-sm-block btn-outline py-1 px-3 btn-sm  float-right rounded-pill mb-2" style="border-color:{{$featured->category->colour}}; color:{{$featured->category->colour}};">{{$featured->forum->name}}</button>
                    </div>
                    <a href="/{{$featured->slug}}">{{$featured->title}} </a><br>
                    <span class="c"><i class="fa fa-comment"></i>&nbsp;{{$featured->replies_count}} {{Str::plural('comment', $featured->replies_count)}}</span>&nbsp;<span class=" v mr-2 items-center text-grey-dark mr-2">&nbsp;
                    @include ('svgs.icons.eye')
                    {{ $featured->visits }} visits
                </span><span class="tm">published {{$featured->created_at->diffForHumans()}}</span>
                </div>
          </div>
            @endforeach
              {!!$getFeatured->links()!!}
            @endif
    </div>
    <div v-show="selectedTab === 'Trending'">
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
   </div>
 </div>
@endsection
