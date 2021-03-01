@include('Admin.header')
@include('Admin.adminNav')

<div style="min-height: 822px;" class="content-wrapper">
  <section class="content-header">
    <h1>Forum</h1>
            <ol class="breadcrumb">
				<li><a href="/admin">Admin Panel</a>
				</li>
				<li><a href="{{url('admin/forums')}}">Forum</a></li>
				<li class="active">Edit Forum</li>
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
    <span></span> 
    <div class="box box">
        <div class="box-header">
            <h3 class="box-title">Edit Forum</h3>
        </div>
        <div class="box-body padding">
        	<form method="POST" class="form-horizontal" action="{{route('admin/forum/update', $forum->id)}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<input name="_method" value="PUT" type="hidden">
						<input name="_user" value="{{$forum->id}}" type="hidden">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="username">Name</label>
						<div class="col-sm-10">
						<input value="{{$forum->name}}" name="name" id="name" placeholder="Enter Forum name" class="form-control" type="text">
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="email">Description</label>
						<div class="col-sm-10">
						<input value="{{$forum->description}}" name="description" id="description" placeholder="Enter a description" class="form-control" type="text">
						</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" name="category">Category</label>
							<div class="col-sm-10">
							<select class="form-control" name="category">
								<option value="{{$forum->category->id}}">
									{{$forum->category->name}}
								<span class="seperator"><br></span>
								</option>
								@foreach($cat as $cats)
									<option value="{{$cats->id}}">{{$cats->name}}</option>
								@endforeach
							</select>	
							</div>
						</div>
						<div class="clearfix"></div>
						<hr>
						<div class="col-sm-10 col-sm-offset-2">
						<button type="submit" class="btn btn-primary">
						Update
						</button>
						</div>
						</form>
	
        </div>
    </div>
</section>
</div>
<script type="text/javascript">
	
</script>
@include('Admin.footer')