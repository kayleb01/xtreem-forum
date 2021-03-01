@include('Admin.header')
        <!-- Main Header -->
 @include('Admin.adminNav')
<div style="min-height: 822px;" class="content-wrapper">
  <section class="content-header">
    <h1><i class="fa fa-dashboard"></i> Create New Category</h1>
            <ol class="breadcrumb">
				<li><a href="/admin">Admin Panel</a>
				</li>
				<li><a href="/admin/categories">Categories</a></li>
				<li class="active">New Category</li>
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
    <div class="box">
        <div class="box-header">
           
        </div>
        
        <div class="box-body padding">
			<form method="POST" class="form-horizontal" action="{{route('admin/categories/store')}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<input name="_method" value="PUT" type="hidden">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="name">Name</label>
						<div class="col-sm-10">
						<input name="name" id="name" placeholder="Enter Name" class="form-control" type="text" required>
						</div>
						</div>

						<div class="form-group">
						<label class="col-sm-2 control-label" for="description">Description</label>
						<div class="col-sm-10">
						<textarea name="description" class="form-control" placeholder="Description of the Category"></textarea>
						</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-10 col-sm-offset-2" style="padding: 10px;">
						<button type="submit" class="btn btn-primary">Create</button>
						</div>
					</form>
				</div>
 			</div>
		</section>
	</div>
</div>
</div>
 @include('Admin.footer')