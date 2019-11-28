 @include('Admin.layouts.ModHead')

@include('Admin.layouts.ModNav')
<section class="content-header">
<h1><i class="fa fa-dashboard"></i>
Banned Users</h1>
<ol class="breadcrumb">
<li><a href="/moderation">Dashboard</a></li>
<li class="active">Banned Users</li>
</ol>

</section>

<!-- Main content -->
<div class="row margin-top-20">
    <div class="col-md-2">
    <div class="nav-tabs-custom">
    <ul class="nav nav-pills nav-stacked">
    <li  >
    <a href="/moderation">Dashboard</a>
    </li>
    <li >
    <a href="/moderation/reported">Reported Posts</a>
    </li>
    <li class="active">
    <a href="/moderation/banned">Banned Users</a>
    </li>
    <li >
    <a href="/moderation/users">Users</a>
    </li>
   @if(Auth::user()->role == 1)
    <li >
    <a href="/admin">Admin Panel</a>
    </li>
    @endif
    </ul>
    </div>
    </div>
<!-- End of the main Nav
     -->
<div class="col-md-10">
    <span id="alert"></span>
    @include('Admin.layouts.errorMessages')
        <script type="text/javascript" src="{{asset('js/jquery-2.2.3.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/Xforum.js')}}"></script>
        <div class="alert-field" id="alert-field"></div>
            <div class="box box-flat" id="pjax-shit">
                <div class="box-header with-border">
                    <form method="GET" action="">
                         {{csrf_field()}}
                        <div class="col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-8 col-sm-8">
                            <div class="input-group">
                                <input type="text" id="search" name="search" placeholder="Search with Username, email or User ID" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default btn-flat">
                                        <i class="fa fa-search"></i>
                                             Search Banned User
                                        </button>
                                    </span>
                            
                            </div>
                        </div>
                    </form>
                        @if(count($user) != 0)
                    <table class="table table-stripped">
                        <tbody>
                            <tr>
                                <th>
                                    Username
                                </th>
                                <th>Ban Time</th>
                                <th>Action</th>
                            </tr>
                            
                            @foreach($user as $users)
                            <tr>
                                <td>{{$users->username}}</td>
                                <td>{{Carbon\Carbon::parse($users->banned_at)->toDateTimeString()}}</td>
                                <td>
                                    <a href="{{url('moderation/revoke', $users->id)}}" class="btn btn-flat">Unban
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @else
                    <br/><br/>
                     <span style="text-align: center;"><h3 class="alert alert-warning">No Banned Users Available</h3></span>
                        @endif
                </div>
            </div>
        </div>  
    </div>
</div>
<section class="content">
</section>

</div>
<span>{{$user->links()}}</span>
</div>
@include('admin.modFooter')
<div class="modal"></div>