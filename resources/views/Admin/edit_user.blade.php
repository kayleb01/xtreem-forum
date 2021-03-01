@include('Admin.header')
@include('Admin.adminNav')

<div style="min-height: 822px;" class="content-wrapper">
  <section class="content-header">
    <h1>All users</h1>
            <ol class="breadcrumb">
				<li><a href="/admin">Admin Panel</a>
				</li>
				<li class="active">Edit user</li>
			</ol>
  </section>
  <script src="{{asset('js/scripts.js')}}" type="text/javascript"></script>
<section class="content">
  <div class="alert-field" id="alert-field"></div> 
     <div class="row margin-bottom-20">
     	<form method="GET" action="{{route('search')}}">
			<div class="col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-8 col-sm-8">
				<div class="input-group">
					<input type="text" name="search" placeholder="Search with Username, email" class="form-control">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default btn-flat">
							<i class="fa fa-search"></i>
							Search User
							</button>
						</span>
				</div>
			</div>
     	</form>
    </div>          
    <div class="box box-flat">
        <div class="box-header">
            <h3 class="box-title">Edit user</h3>
        </div>
        <div class="box-body padding">
        	<form method="POST" class="form-horizontal" action="{{route('admin/update', $user->id)}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<input name="_method" value="PUT" type="hidden">
						<input name="_user" value="{{$user->id}}" type="hidden">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="username">Username</label>
						<div class="col-sm-10">
						<input value="{{$user->username}}" name="username" id="username" placeholder="Enter username" class="form-control" type="text">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="email">Email</label>
						<div class="col-sm-10">
						<input value="{{$user->email}}" name="email" id="email" placeholder="Enter email address" class="form-control" type="email">
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
</section>
</div>
<script type="text/javascript">
	
</script>
@include('Admin.footer')