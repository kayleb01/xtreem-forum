@include('Admin.layouts.ModHead')

@include('Admin.layouts.ModNav')
<section class="content-header">
<h1><i class="fa fa-dashboard"></i>
Moderation</h1>
<ol class="breadcrumb">
<li class="active">Dashboard</li>
</ol>

</section>

<!-- Main content -->
<div class="row margin-top-20">
    <div class="col-md-2">
    <div class="nav-tabs-custom">
    <ul class="nav nav-pills nav-stacked">
    <li class="active" >
    <a href="/moderation">Dashboard</a>
    </li>
    <li>
    <a href="/moderation/reported">Reported Posts</a>
    </li>
    <li>
    <a href="/moderation/banned">Banned Users</a>
    </li>
    <li >
    <a href="/moderation/users">Users</a>
    </li>
    @if(Auth::user()->role_id == 1)
    <li>
        <a href="/admin">Admin Panel</a>
    </li>
    @endif
    </ul>
    </div>
    </div>
<!-- End of the main Nav
     -->

<div class="col-md-10">
        <script type="text/javascript" src="{{asset('js/jquery-2.2.3.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/Xforum.js')}}"></script>
        <div class="alert-field" id="alert-field"></div>
            <div class="box box-flat" id="pjax-shit">
                <div class="box-header with-border">
                    <h3>Welcome <a href="">{{Auth::user()->username}}</a></h3>
                    <div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
	                    <div class="info-box">
	                    	<span class="info-box-icon bg-blue"><i class="fa fa-chrome"></i></span>
		                    <div class="info-box-content">
		                        <span class="info-box-text"><b>Reported posts</b></span>
	                        <span class="info-box-number"><span class="badge alert-success"><a href="/moderation/reported" style="color: white">{{$report}}</a></span><h5>Please attend to reports</h5>
		                        </span>
		                    </div>
	                	</div>
                	</div>
                	<div class="col-md-6 col-lg-6 col-sm-6 col-xs-6">
	                    <div class="info-box">
	                    	<span class="info-box-icon bg-blue"><i class="fa fa-users"></i></span>
		                    <div class="info-box-content">
		                        <span class="info-box-text"><b>Banned users</b></span>
		                        <span class="info-box-number"><span class="badge alert-success"><a href="{{url('moderation/banned')}}" style="color: white">{{$ban}}</span>
		                        </span>
		                    </div>
	                	</div>
                	</div>
            	</div>
            </div>
</div>
</div>
</div>
<section class="content">
</section>
</div>
</div>

@include('Admin.modFooter')