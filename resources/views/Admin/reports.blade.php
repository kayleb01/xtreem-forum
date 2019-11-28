@include('Admin.layouts.ModHead')

@include('Admin.layouts.ModNav')

<section class="content-header">
<h1><i class="fa fa-dashboard"></i>
Moderation</h1>
<ol class="breadcrumb">
<li><a href="/moderation">Dashboard</a></li>
<li class="active">Reported Posts</li>
</ol>

</section>

<!-- Main content -->
<div class="row margin-top-20">
    <div class="col-md-2">
    <div class="nav-tabs-custom">
    <ul class="nav nav-pills nav-stacked">
    <li>
    <a href="/moderation">Dashboard</a>
    </li>
    <li class="active">
    <a href="/moderation/reported">Reported Posts</a>
    </li>
    <li>
    <a href="/moderation/banned">Banned Users</a>
    </li>
    <li >
    <a href="/moderation/users">Users</a>
    </li>
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
                	<span>Reported Post</span>
                 <table class="table table-hover">
                 	<tr>
                 		<th>Post</th>
                 		<th>Reason</th>
                 		<th>User</th>
                 	</tr>
                 	@foreach($report as $reported)
                 	<tr>
                 		<td>{{$reported->post_id}}</td>
                 	</tr>
                 	@endforeach
                 </table>
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