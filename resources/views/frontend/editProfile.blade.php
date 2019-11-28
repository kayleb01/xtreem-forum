@include('frontend.layouts.header')
<div class="content-wrapper">
<div class="container">

<section class="content-header">
	
		<ol class="breadcrumb">
			<li><a href="#">User</a></li>
			<li><a href="#">Edit</a></li>
			<li class="active">{{($user->username)}}</li>
	</ol>

</section>
<br><br>

<!-- Main content -->
<div class="row margin-top-20 col-md-offset-1 col-lg-offset-1">
<div class="col-md-11">
<div class="alert-field" id="alert-field">@if(count($errors)>0) {{dd($errors)}} @endif</div>            
<div class="box box-flat" id="pjax-shit">
<div class="box-header with-border">
<h3 class="box-title">Edit Profile [{!!$user->username!!}]</h3>
</div>
<div class="box-body">    
<form method="POST" class="form-horizontal" action="{{route('user/update', $user->id)}}" enctype="multipart/form-data">
{{csrf_field()}}
<input name="_method" value="PUT" type="hidden">
<input name="_user" value="{{$user->id}}" type="hidden">
<div class="form-group">
<label class="col-sm-2 control-label" for="username">Username</label>
<div class="col-sm-10">
<input value="{{$user->username}}" name="username" readonly="on" id="username" placeholder="Enter username" class="form-control" type="text">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="email">Email</label>
<div class="col-sm-10">
<input value="{{$user->email}}" name="email" id="email" readonly="on" placeholder="Enter email address" class="form-control" type="email">
<span class="input-group-btn">
        <button class="btn btn-primary" type="button">Change Email</button>
</span>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="avatar">Location</label>
<div class="col-sm-10">
<input value="{{$user->location}}" name="location" id="location" placeholder="Your Location" class="form-control" type="text">
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="sex">Gender</label>
<div class="col-sm-10">
	<select class="form-control" name="sex">
		@if(empty($user->sex))
		<option value="male">Male</option>
		<option value="female">Female</option>
		@elseif($user->sex == 'male')
		<option value="male">Male</option>
		<option value="female">Female</option>
		@else
		<option value="female">Female</option>
		<option value="male">Male</option>
		@endif
	</select> 
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label" for="bio">Bio</label>
<div class="col-sm-10">
<textarea name="bio" class="form-control" maxlength="106" placeholder="Bio">{{$user->bio}}</textarea>
</div>

</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="note_on_user">Website|Fb|Twitter</label>
<div class="col-sm-10">
<input type="text" name="website" value="{{$user->website}}" class="form-control" placeholder="Website, Facebook or Twitter handle">
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="note_on_user">Date of Birth</label>
<div class="col-sm-10">
<input type="text" name="dob" value="{{$user->dob}}" class="form-control" placeholder="Date of Birth">
</div>
</div>                   
<div class="clearfix"></div>
<hr>
<div class="col-sm-10 col-sm-offset-2">
<a href="{{url('user/'. $user->username .'')}}" class="btn btn-default">
<i class="fa fa-times"></i>
Back
</a>
<button type="submit" class="btn btn-success">
<i class="fa fa-check"></i> Update
</button>
@if(Auth::user()->role == 1 || Auth::user()->role == 2 )
<a class="btn btn-danger" href="{{url('moderation/'. $user->id.'/ban')}}">
<i class="fa fa-ban"></i>
Ban
</a>
@endif
</div>
</form>
</div>
</div>
</div>
</div>
<section class="content">
</section>

</div>

</div>









@include('frontend.layouts.footer')