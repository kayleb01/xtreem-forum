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
                    <a href="/forum/{{$forum->slug}}" title="{{$forum->description}}" class="btn btn-outline-secondary rounded-full mb-1 btn-xtrm" style="">{!! $forum->name!!}</a> 
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
                  @if ($featured->pinned)
                      <small class="font-weight-bold">Pinned:</small>  
                    @endif
                    <a href="/{{$featured->slug}}">{{$featured->title}} </a><br>
                    <span class="c"><i class="fa fa-comment"></i>&nbsp;{{$featured->replies_count}} {{Str::plural('comment', $featured->replies_count)}}</span>&nbsp;&nbsp;<span class=" v mr-2 flex items-center text-grey-darker text-2xs font-semibold mr-4">
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
