<div class="wrapper">
<header class="main-header">
<nav class="navbar navbar-static-top">
<div class="container">
<div class="navbar-header">
<a href="{{url('/admin')}}" class="navbar-brand"><b>XtreemForum</b></a>
<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
<i class="fa fa-bars"></i>
</button>
</div>

<div class="collapse navbar-collapse pull-left" id="navbar-collapse">
<ul class="nav navbar-nav">
<li >
<a href="#">Forum</a>
</li>

<li >
<a href="moderation/users">All users</a>
</li>
<li class="dropdown">

<ul class="dropdown-menu" role="menu">
<li><a href="/moderation">Dashboard</a>
<li>
<a href="moderation/reported">Reported Posts
<span class="badge alert-success">9</span>
</li>
</ul>
</li>
<li class="dropdown">
<ul class="dropdown-menu" role="menu">
<li><a href="/admin">Admin Panel</a>
</ul>
</li>

</ul>
</div>

<!-- Navbar Right Menu -->
<div class="navbar-custom-menu">
<ul class="nav navbar-nav">
<li class="dropdown user user-menu">
<!-- Menu Toggle Button -->
<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
<!-- The user image in the navbar-->

<!-- hidden-xs hides the username on small devices so only the image appears. -->
<span class="hidden-xs">{{Auth::user()->username}}</span>
<span class="caret"></span>
</a>
<ul class="dropdown-menu">
<!-- The user image in the menu -->
<li class="user-header">
<img src="#" class="img-circle" alt="Avatar">

<p>
admin
</p>
</li>
<!-- Menu Body -->
<li class="user-body">
<div class="row">
<div class="col-xs-4 text-center">
<a href="/profile/{{Auth::user()->username}}/threads">Threads</a>
</div>
<div class="col-xs-4 text-center">
<a href="profile/admin/posts">Posts</a>
</div>
<div class="col-xs-4 text-center">
<a href="/profile">Settings</a>
</div>
</div>
</li>
<!-- Menu Footer-->
<li class="user-footer">
<div class="pull-left">
<a href="admin" class="btn btn-default btn-flat">View Profile</a>
</div>
<div class="pull-right">
<a href="/logout" class="btn btn-default btn-flat">Logout</a>
</div>
</li>
</ul>
</li>                    </ul>
</div>


</div>
</nav>
</header> 
<div class="content-wrapper">
<div class="container">

