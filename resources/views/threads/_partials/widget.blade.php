<div class="col-lg-2 col-md-2 mt-2 d-none d-sm-block">
  <button class="btn btn-secondary btn-block rounded-pill">New Topic</button>
  <ul class="list-group align-center ml-3 mt-4">
    <li class="list-item"><a href="#" class="link"><i class="fa fa-compass" arial-hidden="true"></i> Most Recent</a></li>
    <li class="list-item"> <a href="#" class="link"><i class="fa fa-circle-thin fa-sm" arial-hidden="true"></i> New</a></li>
  </ul>
        @if(Auth::check()) 
    <div class="pane-widget p-2 ">
        <ul class="list-group mt-1 list-wig p-2">
          <li class=" mb-2 first-item"><img src="/storage/storage/img/{{Auth::user()->avatar? Auth::user()->avatar : 'default.jpg'}}" class="image-circle rounded-pill"></li>   
          <!-- <li class="list-group-items"><i class="fa fa-edit"></i> <a class="" href="{{url('/user/'.Auth::user()->username.'/edit')}}">Edit Profile</a></li> -->
          <li class="list-group-items"><i class="fa fa-user-o" arial-hidden="true"></i> <a href="/user/{{Auth::user()->username}}" class="link">View Profile</a></li>
          <li class="list-group-items"><i class="fa fa-square-o" arial-hidden="true"></i> <a href="{{url('/user/threads/'.Auth::user()->username.'')}}" class="link">Threads</a></li>
          <li class="list-group-items"><a href="#"><i class="fa fa-comments-o" arial-hidden="true"></i> Comments</a></li>
          <li class="list-group-items"><i class="fa fa-power-off" arial-hidden="true"></i> <a href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();" class="">Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
            </form>
          </li>
        </ul>
      </div>
              @endif  
 
               
<!--            
               <div class="panel-heading p-2 font-weight-bold">New Threads</div>
                @if($newThread ?? '' )
                     @foreach($newThread ?? '' as $nw_thread)
                    <div class="panel panel-body align-item-center">
                      <div class="widget">
                       <a href="{{$nw_thread->path}}">
                         {{$nw_thread->title}} &sdot;
                       </a>
                       <span class="tm bord">{{$nw_thread->time->diffForHumans()}}</span>
                    </div> 
                    @endforeach
                    @else
                    <i class="fa fa-spin fa-spinner" style="align-content: center;"></i><br><br>
                  @endif
                  </div> -->
              
        </div> 
        