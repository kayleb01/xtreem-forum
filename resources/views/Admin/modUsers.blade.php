	@include('Admin.layouts.ModHead')
	@include('Admin.layouts.ModNav')
	<section class="content-header">
		<h1><i class="fa fa-dashboard"></i>
		Users</h1>
		<ol class="breadcrumb">
		<li><a href="/moderation">Dashboard</a></li>
		<li class="active">Users</li>
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
	<li>
	<a href="/moderation/banned">Banned Users</a>
	</li>
	<li class="active">
	<a href="/moderation/users">Users</a>
	</li>
	@if(Auth::user()->role === 1)
	<li>
		<a href="/admin">Admin Panel</a>
	</li>
	@endif
	</ul>
	</div>
	</div>
	<!-- 
		End of the main Nav
 -->	<div class="col-md-10">
		<div class="alert-field" id="alert-field"></div>
			 <div class="box box-flat" id="pjax-shit">
				<div class="box-header with-border">
					<h3 class="box-title">Users</h3>
						<div class="box-tools">
					<form method="GET" action="{{route('moderation/search')}}">
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
							<hr>
							<br><br>

						</div>
				</div>
				<div class="box-body">
					@include('Admin.layouts.errorMessages')
				<table class="table vertical-align ">
					        	<tbody>
					                <tr>
					                    <th>Username</th>
					                    <th class="hidden-xs">Email</th>
					                    <th class="hidden-sm hidden-xs">Registered</th>
					                    <th class="hidden-sm hidden-xs">Last active</th>
					                    <th width="120px">Actions</th>
					                </tr>
					                @if(!empty($user))


					                @foreach($user as $users)
					                	<tr>
											<td>{{$users->username}}</td>
											<td class="hidden-xs">{{$users->email}}</td>
											<td class="hidden-sm hidden-xs">{{($users->created_at)}}</td>
											<td class="hidden-sm hidden-xs">{{$users->updated_at}}</td>
											<td>
											<div class="dropdown">
											<a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="#" aria-expanded="true">
											Options
											<span class="caret"></span>
											</a>
											<ul class="dropdown-menu">
											<li role="presentation">
											    <a role="menuitem" tabindex="-1" target="_blank" href="{{url('user/' . $users->username . '')}}">View Profile</a>
											</li>
											<li role="presentation">
											    <a role="menuitem" tabindex="-1" href="{{url('/moderation/user/'. $users->id.'/edit')}}">Edit User</a>
											</li>
											<li role="presentation">
											    <a role="menuitem" tabindex="-1" href="{{url('moderation/' . $users->id . '/ban')}}">Ban User</a>
											</li>
											<li role="presentation" class="divider"></li>
											<li role="presentation">
											   <a href="{{route('moderation/destroy', $users->id)}}" onclick="event.preventDefault(); document.getElementById('delete_form').submit()">Delete user</a>
						    <form id="delete_form" method="POST" action="{{route('moderation/destroy')}}" style="display: none;">
						    	<input type="hidden" name="_method" value="delete">
								<input type="hidden" name="_user" value="{{$users->id}}">
							{{csrf_field()}}
							</form>
											</li>
											</ul>
											</div>
											</td>
					                    </tr>
					                    @endforeach


					                    @endif
					                    @if(empty($user) == true)
					                    <tr>
					                    	<td><h4>No User Found!</h4></td>
					                    </tr>
					                    @endif
					            </tbody>
					        </table>
					        </div>
				@if(empty($user))
				<div class="box-body">There are no banned users.</div>
				@endif
			</div>
	</div>
</div>
<section class="content">
</section>

</div>
<div class="pagination">{{$user->links()}}</div>
</div>
@include('Admin.modFooter')
<div class="modal fade" tabindex="-1" role="dialog" id="delete" aria-labelledby="deleteModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button class="close" data-dismiss="modal" arial-label="Close"><span arial-hidden="true">&times;</span></button>
				<h3 class="modal-title">Delete</h3>
			</div>
					<div class="modal-body">
						<span><h3>You about to <b>delete</b>, this cannot be undone</h3></span>
					</div>	
						<div class="modal-footer"><button class="btn btn-danger" data-dismiss="modal" arial-hidden="true">Close</button></div>
		</div>
	</div>
</div>