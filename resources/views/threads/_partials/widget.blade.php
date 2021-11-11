<div class="col-lg-2 col-md-2 mt-2 d-none d-sm-block">
  <ul class="list-group align-center ml-3 mt-4">
    <li class="list-item"><a href="#" class="link"><i class="fa fa-compass" arial-hidden="true"></i> Most Recent</a></li>
    <li class="list-item"> <a href="#" class="link"><i class="fa fa-circle-thin fa-sm" arial-hidden="true"></i> New</a></li>
  </ul>
        @if(Auth::check())
          <div class="pane-widget p-2 ">
              <ul class="list-group mt-1 list-wig p-2">
                <li class=" mb-2 first-item"><a href="/u/{{Auth::user()->username}}"><img src="{{Auth::user()->avatar? Auth::user()->avatar : 'default.jpg'}}" class="image-circle rounded-pill"></a></li>
                <!-- <li class="list-group-items"><i class="fa fa-edit"></i> <a class="" href="{{url('/user/'.Auth::user()->username.'/edit')}}">Edit Profile</a></li> -->
                <li class="list-group-items"><i class="fa fa-user-o" arial-hidden="true"></i> <a href="/u/{{Auth::user()->username}}" class="link">View Profile</a></li>
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

        @include('threads._partials.sidebar')
        </div>
