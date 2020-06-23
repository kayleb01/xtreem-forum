   @extends('layouts.app')

@section('content')

<div class="card pt-1 ">
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
 </div> <!--EndOfContainer -->
 <div class="container">
  <div class="row">
   <div class="col-lg-2 col-md-2 mt-1  d-none d-sm-block">
   <button class="btn btn-primary btn-block rounded-pill">New Topic</button>
   <ul class="list-group align-center ml-3 mt-2">
   <li class=""><a href="#" class="link">Most Recent</a></li>
   <li> <a href="#" class="link">New</a></li>
   </ul>

   </div>

   <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
  
      <div class="tab nav-tabs mb-1">
      <button v-for="(tab, index) in tabs" :key="index" :class="{ active: selectedTab === tab}" id="tablinks"
    @click="selectedTab = tab"> @{{ tab }}</button>
      </div>
      <div v-show="selectedTab == 'Featured'" class="shadow-sm">
          @if(isset($getFeatured))
                @foreach($getFeatured as $key => $featured)
                  @if(!Auth::check())  
                    @if($key++ % 9 == 1)
                      <div class='heading pt-0' style='text-align: center;'> 
                          <a href="/register" target="_blank">
                            <img src="storage/storage/img/advert.jpg" alt=""><br>
                          </a>
                     
                      <a href='/register' class="text-blue">Register</a> and <a href='/login' class="text-blue">Login</a> to join our community</div>
                    @endif
            @endif
            <div class="forum_title rounded">
             
               <a href="/user/{{$featured->user->username}}"><img class="image-circle" src="/storage/storage/img/{{$featured->user->avatar ? $featured->user->avatar : 'default.jpg'}}"></a> 
                <div class="featured"> 
                  @if ($featured->pinned)
                      <small class="font-weight-bold">Pinned:</small>  
                    @endif
                    <div class="d-none d-sm-block">97 
                    <button class="btn d-none d-sm-block btn-outline-primary py-1 px-3 btn-sm border-info float-right rounded-pill mb-2">{{$featured->forum->name}}</button>
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
   <!-- SideWidget -->
    @include('threads._partials.widget')
  </div>
 </div>
 

@endsection
