<div class="col-md-3 col-lg-3 hidden-sm hidden-xs widget-over ">
        @if(Auth::check()) 
          <div class="panel-heading p-2 font-weight-bold">User Profile
            </div>
              <div class="panel-body  align-item-center">
                <center class="align-items-center">
                    
                      <ul class="list-group widget2"><img src="/storage/storage/img/{{Auth::user()->avatar}}" class="image-circle">
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
            <div class="panel">
              <div class="panel-heading p-2 font-weight-bold">New Threads</div>
                @if($newThread ?? '' )
                     @foreach($newThread ?? '' as $nw_thread)
                    <div class="panel">
                      <div class="widget">
                       <a href="{{$nw_thread->path}}">
                         {{$nw_thread->title}} &sdot;
                       </a>
                       <span class="tm bord">{{$nw_thread->time->diffForHumans()}}</span>
                    </div>
                    </div>
                   @endforeach
                   @else
                   <i class="fa fa-spin fa-spinner" style="align-content: center;"></i><br><br>
                  @endif
              </div>
        </div> 
        