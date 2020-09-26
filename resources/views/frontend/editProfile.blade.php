@extends('layouts.app')
@section('content')
<div class="container">
	
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="jumbotron bg-img mt-2 text-light d-flex justify-content-center" style="height: 108px !important; margin-bottom: 85px;">
			<div class="d-flex justify-center img_edit mt-3 text-dark rounded"><i class="fa fa-edit fa-lg"></i></div>
              <img src="/storage/storage/img/{{$user->avatar}}" class="user-image mt-3" >
  		</div>
			<div class="panel panel-body " style="padding:20px; margin-top:105px">
				<legend>
					Update profile
				</legend>
				<form action="{{url('u/'. $user->username . '/store')}}" enctype="multipart/form-data" method="POST">
				{{csrf_field()}}
					<div class="form-group">
						<label for="birthday" class="col-md-4 col-form-label ">{{ __('Date of birth') }}</label>
						<input type="date" name="birthday" class="form-control rounded-pill" value="{{$user->dob}}">
					</div>
					<div class="form-group">
						<label for="location" class="col-md-4 col-form-label ">{{ __('Location') }}</label>
						<input type="text" name="location" class="form-control rounded-pill" value="{{$user->location}}">
					</div>
					<div class="form-group">
						<label for="bio" class="col-md-4 col-form-label ">{{ __('Bio') }}</label>
						<input type="text" name="bio" class="form-control rounded-pill" value="{{$user->bio}}">
					</div>
					<div class="form-group">
						<label for="birthday" class="col-md-4 col-form-label ">{{ __('Website') }}</label>
						<input type="text" name="web" class="form-control rounded-pill" value="{{$user->website}}">
					</div>
					<div class="form-group">
						<input type="submit" value="Save" class="btn btn-secondary btn-block rounded-pill">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection