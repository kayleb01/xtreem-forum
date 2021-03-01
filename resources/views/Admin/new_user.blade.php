@include('Admin.header')
@include('Admin.adminNav')
<div style="min-height: 822px;" class="content-wrapper">
  <section class="content-header">
    <h1><i class="fa fa-dashboard"></i> Create <U></U>ser</h1>
            <ol class="breadcrumb">
				<li><a href="/admin">Admin Panel</a>
				</li>
				<li class="active">New User</li>
			</ol>
			<script src="{{asset('js/scripts.js')}}" type="text/javascript">
			
			</script>
  </section>
<section class="content">
  <div class="alert-field" id="alert-field"></div> 
     <div class="row margin-bottom-20">
     <form method="GET" action="{{route('search')}}">
     		{{csrf_field()}}
			<div class="col-md-5 col-md-offset-7 col-lg-4 col-lg-offset-8 col-sm-8">
					<div class="input-group">
						<input type="text" id="search" name="search" placeholder="Search with Username, email or User ID" class="form-control">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default btn-flat">
								<i class="fa fa-search"></i>
								Search User
								</button>
							</span>
							<ul id="results">
								
							</ul>
					</div>
				</form>
			</div>
     
    </div>          
    <div class="box box-flat">
        <div class="box-header">
            <h3 class="box-title">Create User</h3>
        </div>
        
        <div class="box-body padding">
			<form method="POST" class="form-horizontal" action="{{route('admin/store')}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<input name="_method" value="PUT" type="hidden">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="username">Username</label>
						<div class="col-sm-10">
						<input name="username" id="username" placeholder="Enter username" class="form-control" type="text" required>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="email">Email</label>
						<div class="col-sm-10">
						<input  name="email" id="email" placeholder="Enter email address" class="form-control" type="email" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label" for="avatar">Location</label>
						<div class="col-sm-10">
						<input name="location" id="location" placeholder="Your Location" class="form-control" type="text" required>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="sex">Gender</label>
						<div class="col-sm-10">
						<select class="form-control" name="sex">
					
						<option value="male">Male</option>
						<option value="female">Female</option>
						</select> 
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="bio">Bio</label>
						<div class="col-sm-10">
						<textarea name="bio" class="form-control" maxlength="106" placeholder="Bio" required></textarea>
						</div>

						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label" for="note_on_user">Date of Birth</label>
						<div class="col-sm-10">
						<input type="text" name="dob" class="form-control" placeholder="Year/Month/Day" required>
						</div>
						</div>
						<div class="form-group">
						<label class="col-sm-2 control-label" for="pass">Password</label>
						<div class="col-sm-10">
						<input type="Password" name="pass" class="form-control" placeholder="password" required>
						</div>
						</div>   
						<div class="form-group">
						<label class="col-sm-2 control-label" for="password_confirmation">Confirm Password</label>
						<div class="col-sm-10">
						<input type="Password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
						</div>
						</div>                  
						<div class="clearfix"></div>
						<div class="col-sm-10 col-sm-offset-2" style="padding: 10px;">
						<button type="submit" class="btn btn-primary">Create User</button>
						</div>
					</form>
				</div>
 			</div>
		</section>
	</div>
</div>
</div>
@include('Admin.footer')