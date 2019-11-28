@include('Admin.header')
@include('Admin.adminNav')
<div style="min-height: 822px;" class="content-wrapper">
  <section class="content-header">
    <h1>All users</h1>
            <ol class="breadcrumb">
				<li><a href="/admin">Admin Panel</a>
				</li>
				<li class="active">All users</li>
			</ol>
			<script src="{{asset('js/scripts.js')}}" type="text/javascript">
			
			</script>
  </section>
<section class="content">
	@include('Admin.layouts.errorMessages')
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
					</div>
				</form>
			</div>
     
    </div>          
    <div class="box box-flat">
        <div class="box-header">
            <h3 class="box-title">All users</h3>
        </div>
        
        <div class="box-body no-padding">
        <table class="table vertical-align table-hover">
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
						    <a role="menuitem" tabindex="-1" href="{{url('admin/'. $users->id . '/edit')}}">Edit User</a>
						</li>
						
						<li role="presentation" class="divider"></li>
						<li role="presentation">
						    <a href="#" onclick="event.preventDefault(); document.getElementById('delete_form').submit()")">Delete user</a>
						    <form id="delete_form" method="POST" action="{{route('admin.destroy', [$users->id])}}" style="display: none;"><input type="hidden" name="_method" value="delete">
						    	<!-- <input type="hidden" name="_user" value="{{$users->id}}"> -->
							{{csrf_field()}}</form>
						</li>
						@if($users->isBanned())
						<li role="presentation">
						    <a role="menuitem" tabindex="-1" href="{{url('moderation/revoke', $users->id)}}" style="color:red">UnBan</a>
						</li>
						@else
						<li role="presentation">
						    <a role="menuitem" tabindex="-1" href="/moderation/{{$users->id}}/ban">Ban User</a>
						</li>
						@endif

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
    </div>
    <span>{{$user->links()}}</span>
</section>
</div>
</div>
</div>
@include('admin.footer')