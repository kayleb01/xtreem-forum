 <header class="main-header">
            <!-- Logo -->
            <a href="{{route('/')}}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">XF</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">XtremeForum</span>
            </a>

            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
    <!-- Menu Toggle Button -->
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
        <!-- The user image in the navbar-->
       <!--  <img src="Admin_pix" class="user-image" alt="User Image"> -->
        <!-- hidden-xs hides the username on small devices so only the image appears. -->
        @if(!Auth::guest())
        <span class="hidden-xs">{{Auth::user()->username}}</span>
        @endif
    </a>
    <ul class="dropdown-menu">
        <!-- The user image in the menu -->
        <li class="user-header">
            <img src="" class="img-circle" alt="Avatar">
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
                <div class="col-xs-4 text-center">
                    <a href="#">Threads</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Posts</a>
                </div>
                <div class="col-xs-4 text-center">
                    <a href="#">Edit Profile</a>
                </div>
            </div>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">View Profile</a>
            </div>
            <div class="pull-right">
                 <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                            </form>
            </div>
        </li>
    </ul>
</li>                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">

    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{route('admin')}}"><i class="fa fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
               <a href="{{route('admin/users')}}"><i class="fa fa-users">
            </i>
                <span>Users</span>
            <i class="fa fa-angle-left pull-right"></i>
                </a>
            <ul class="treeview-menu">
                <li>
                    <a href="{{route('admin/users')}}"><i class="fa fa-list">
                </i>
                    <span>All Users</span>
                    </a>
            </li>
            <li>
                <a href="{{url('admin/new')}}"><i class="fa fa-user-plus">
            </i>
                 <span>New User</span>
                </a>
            </li>
                <li><a href="{{url('admin/users/deleted')}}"><i class="fa fa-user-times"></i><span>Deleted Users</span></a></li>
                <li>
                    <a href="#"><i class="fa fa-ban">
                </i>
                    <span>Banned Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                    </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="{{url('moderation/banned')}}"><i class="fa fa-user-times">
                            </i>
                                <span>Ban a User</span>
                                </a>
                            </li>
                                <li>
                                    <a href="#"><i class="fa fa-list">
                                </i>
                                <span>Ban Records</span>
                                    </a>
                                </li>
                        </ul>
                        </li>
                    </ul>
                </li>
            <li>
                <a href="#"><i class="fa fa-shield">
            </i>
            <span>User Roles</span>
                <i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
    <li>
       <a href="{{url('moderation')}}" target="_blank"><i class="fa fa-rocket"></i>
          <span>Moderation</span>
       </a>  
    </li>
    <li><a href="{{url('admin/roles')}}"><i class="fa fa-list"></i>
        <span>View Roles</span>
    </a>
    </li>
    <li><a href="{{url('admin/role')}}"><i class="fa fa-plus"></i>
        <span>New Role</span>
    </a>
    </li>
    <li><a href="#"><i class="fa fa-circle-o"></i>
        <span>Permissions</span>
    </a>
    </li>
    <li><a href="#"><i class="fa fa-plus-circle"></i>
        <span>New Permission</span>
    </a>
    </li>
</ul>
</li>
<li>
 <a href="#"><i class="fa fa-comments"></i>
<span>Forum</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="{{url('admin/forums')}}"><i class="fa fa-list-alt"></i>
<span>View Forums</span>
</a>
</li>
<li><a href="{{url('admin/forum/removed')}}"><i class="fa fa-trash"></i>Deleted Threads</a></li>
<li><a href="{{url('admin/forum/new')}}"><i class="fa fa-plus"></i>
<span>New Forum</span>
</a>
</li>
<li><a href="/admin/categories"><i class="fa fa-caret-square-o-up"></i>Categories</a></li>
<li><a href="/admin/categories/create"><i class="fa fa-plus"></i>Add Category</a></li>
</ul>
</li>
<li>
<a href="#"><i class="fa fa-file"></i>
<span>Pages</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="/admin/pages"><i class="fa fa-files-o"></i>
<span>Manage Pages</span>
</a>
</li>
<li><a href="/admin/pages/add"><i class="fa fa-plus"></i>
<span>Create Page</span>
</a>
</li>
</ul>
</li>
<li>
<a href="#"><i class="fa fa-gear"></i>
<span>Configuration</span>
<i class="fa fa-angle-left pull-right"></i>
</a>
<ul class="treeview-menu">
<li><a href="#"><i class="fa fa-user"></i>
<span>User Settings</span>
</a>
</li>
<li><a href="#"><i class="fa fa-comment"></i> <span>Forum Settings</span>
 </a>
</li>
<li><a href="#"><i class="fa fa-wrench"></i>
<span>Site Settings</span>
 </a>
</li>
 </ul>
 </li>
 <li>
 <a href="#"><i class="fa fa-wrench"></i>
 <span>Tools</span>
  <i class="fa fa-angle-left pull-right"></i>
 </a>
 <ul class="treeview-menu">
 <li><a href="#"><i class="fa fa-medkit"></i>
 <span>Site Health</span>
 </a>
</li><li><a href="#"><i class="fa fa-hdd-o"></i>
    <span>Cache Manager</span>
    </a>
</li>
<li><a href="#"><i class="fa fa-info"></i>
  <span>PHP Info</span>
</a>
</li>   
</ul>

</ul>
<ul class="treeview-menu">
    
</li>
</ul>

</section>
</aside>