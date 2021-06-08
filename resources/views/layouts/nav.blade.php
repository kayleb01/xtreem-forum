           @if(Auth::user()->role == 1 || Auth::user()->role == 2)
            <li class="nav-item  ">
                <a href="
                @if(Auth::user()->role == 1)
                    /admin/dashboard
                @elseif(Auth::user()->role == 2)
                /moderation
                @endif
                " class="nav-link text-light">
                    Admin
                </a>
            </li>
            @endif
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle text-light" id="dropdownMenuButton" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true"> <i class="fa fa-user fa-lg"></i> </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{url('/user/threads/'.auth()->user()->username.'')}}"><i class="fa fa-history"></i> Threads</a>
                        <a class="dropdown-item" href="{{url('/user/'.auth()->user()->username.'/edit/')}}"><i class="fa fa-edit"></i> Edit Profile</a>
                        <a class="dropdown-item" href="/user/{{auth()->user()->username}}"><i class="fa fa-user"></i> View Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i> Logout
                        </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                    </div>

            </li>
            <user-notifications></user-notifications>
