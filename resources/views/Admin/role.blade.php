@include('Admin.header')
@include('Admin.adminNav')
<div style="min-height: 822px;" class="content-wrapper">
  <section class="content-header">
    <h1><i class="fa fa-dashboard"></i> Create <U></U>ser</h1>
            <ol class="breadcrumb">
				<li><a href="/admin">Admin Panel</a>
				</li>
				<li class="active">New Role</li>
			</ol>
			<script src="{{asset('js/scripts.js')}}" type="text/javascript">
			
			</script>
  </section>
		<section class="content">
		<div class="panel panel-body " style="padding: 5px">
                            <form action="{{route('admin/role')}}" method="POST" class="form-horizontal">
                               <div class="col-sm-10">
                                    <div class="form-group{{ $errors->has('forum') ? ' has-error' : '' }}">
                                            
                                            <label class="col-sm-2 control-label" for="forum">User</label>
                                            <div class="">
                                               <select name="user" class="form-control rounded-pill">
											   @foreach($users as $user)
											   	<option value="{{$user->id}}" class="form-control rounded-pill">{{$user->username}}</option>
												@endforeach
											   </select>
                                            </div>
                                             @if ($errors->has('user'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('user') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                        
                                            <label class="col-sm-2 control-label" for="role">Role</label>
                                                <div class="">
                                                    <select name="role" class="form-control rounded-pill">
														<option value="1"> Super Admin</option>
														<option value="2"> Moderator </option>
													</select>
                                                  <br>
                                                </div>
                                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                                             @if ($errors->has('role'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('role') }}</strong>
                                                </span>
                                             @endif 
                                                {{csrf_field()}}
                                        </div>
										<label class="col-sm-2 control-label" for="forum">Forum</label>
                                            <div class=" mb-2">
                                               <select name="forum" class="form-control rounded-pill ">
                                               <option value="">--Select--</option>
											   @foreach($forums as $forum)
											   	<option value="{{$forum->id}}">{{$forum->name}}</option>
												@endforeach
											   </select>
                                            </div>
                                             @if ($errors->has('forum'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('forum') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <button type="submit" class=" mb-3 btn btn-secondary btn-block rounded-pill">
                                            Create
                                            </button><br>
                                     </div> 
                                 </div>
                            </form>
                        </div>
		</section>
	</div>
</div>
</div>
@include('Admin.footer')