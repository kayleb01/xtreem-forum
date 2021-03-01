@include('Admin.header')
@include('Admin.adminNav')
<div style="min-height: 822px;" class="content-wrapper">
  <section class="content-header">
    <h1>User Roles</h1>
            <ol class="breadcrumb">
				<li><a href="/admin">Admin Panel</a>
				</li>
				<li class="active">All User Roles</li>
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
            <h3 class="box-title">User Roles</h3>
        </div>
        
        <div class="box-body no-padding">
        <table class="table vertical-align table-hover">
        	<tbody>
                <tr>
                    <th>Role</th>
                    <th class="hidden-sm hidden-xs">Permissions</th>
                    <th width="120px">Actions</th>
                </tr>
                @if(!empty($role))


                @foreach($role as $roles)
                	<tr>
						<td>{{$roles->role}}</td>
						<td class="hidden-xs">{{$roles->permissions}}</td>
						<td>
							<div class="dropdown">
								<a class="dropdown-toggle btn btn-default" data-toggle="dropdown" href="#" aria-expanded="true">
								Options
								<span class="caret"></span>
								</a>
								<ul class="dropdown-menu">
									<li role="presentation">
										<a href="{{url('admin/role/'.$roles->id.'/edit')}}">Edit</a>
									</li>
								</ul>
							</div>
						</td>	
					
                    </tr>
                    @endforeach


                    @endif
                    @if(empty($role) == true)
                    <tr>
                    	<td><h4>No User Role Found!</h4></td>
                    </tr>
                    @endif
            </tbody>
        </table>
        </div>
    </div>
</section>
</div>
</div>
</div>
@include('Admin.footer')