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

