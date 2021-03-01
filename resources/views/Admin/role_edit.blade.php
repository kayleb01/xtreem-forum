@include('Admin.header')
@include('Admin.adminNav')
<div style="min-height: 820px;" class="content-wrapper">
  <section class="content-header">
    <h1>User Roles</h1>
            <ol class="breadcrumb">
				<li><a href="/admin">Admin Panel</a>
				</li>
				<li class="active">Edit User Role</li>
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
            <h3 class="box-title">Edit user role</h3>
        </div>
        <div class="box-body padding">
        	<form method="POST" class="form-horizontal" action="{{route('admin/role/store', $role->id)}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<input name="_method" value="PUT" type="hidden">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="role">Role</label>
						<div class="col-sm-10">
					@if($role->role === 'Admin')
						<input value="{{$role->role}}" readonly="ON" name="role" id="role" placeholder="Enter role" class="form-control" type="text">
					@else
						<input value="{{$role->role}}" name="role" id="role" placeholder="Enter role" class="form-control" type="text">
					@endif
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="permission">Permission</label>
						<div class="col-sm-10">
						<input value="{{$role->permissions}}" name="permission" id="permission" placeholder="Enter Permissions" class="form-control" type="text">
						</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">Update
						</button>
						</div>
						</form>
	
        </div>
    </div>
</section>
</div>
@include('Admin.footer')