@include('Admin.layouts.ModHead')

@include('Admin.layouts.ModNav')
<script type="text/javascript" src="{{asset('js/scripts.js')}}"></script>
<section class="content-header">
<h1><i class="fa fa-dashboard"></i>
Banned Users</h1>
<ol class="breadcrumb">
<li><a href="/moderation">Dashboard</a></li>
<li class="active">Banned Users</li>
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
    <li class="active">
    <a href="/moderation/banned">Banned Users</a>
    </li>
    <li >
    <a href="/moderation/users">Users</a>
    </li>
    </ul>
    </div>
    </div>
<!-- End of the main Nav
     -->
<div class="col-md-10">

<div class="box box-flat" id="pjax-shit">
	<div class="box-header with-border">
		<h3 class="box-title">Ban a User</h3>
	</div>
		<div class="box-body">
			<form id="ban-user" method="POST" class="form-horizontal" action="{{route('/moderation')}}">
				{{csrf_field()}}
				<div class="row">
				@if(count($errors) > 0)
				<div class="alert alert-danger">{{$errors}}</div>
				@endif
				@include('Admin.layouts.errorMessages')
					<div class="col-sm-6 form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label" for="username">User</label>
								<div class="col-sm-8">
									<input autocomplete="off" value="{{$user->username}}" readonly="on" name="username" placeholder="Username" class="form-control" type="text" required>
									<input type="hidden" name="id" value="{{$user->id}}">
								</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="length">Ban Length</label>
					<div class="col-md-4 col-sm-6">
						<select name="length" id="length" class="form-control">
							<optgroup label="Minutes">
								<option selected="selected" value="{{$carbon->addMinutes(5)}}">5 Minutes</option>
								<option value="{{$carbon->addMinutes(10)}}">10 Minutes</option>
								<option value="{{$carbon->addMinutes(30)}}">30 Minutes</option>
								<option value="{{$carbon->addMinutes(45)}}">45 Minutes</option>
							</optgroup>
							<optgroup label="Hours">
								<option value="{{$carbon->addHours(1)}}">1 Hour</option>
								<option value="{{$carbon->addHours(2)}}">2 Hours</option>
								<option value="{{$carbon->addHours(4)}}">4 Hours</option>
								<option value="{{$carbon->addHours(5)}}">5 Hours</option>
								<option value="{{$carbon->addHours(10)}}">10 Hours</option>
								<option value="{{$carbon->addHours(24)}}">24 Hours</option>
							</optgroup>
							<optgroup label="Days">
								<option value="{{$carbon->addDays(2)}}">2 Days</option>
								<option value="{{$carbon->addDays(5)}}">5 Days</option>
								<option value="{{$carbon->addDays(10)}}">10 Days</option>
								<option value="{{$carbon->addDays(20)}}">20 Days</option>
							</optgroup>
							<optgroup label="Month">
								<option value="{{$carbon->addMonth()}}">1 Month</option>
								<option value="{{$carbon->addMonths(6)}}">6 Months</option>
								<option value="{{$carbon->addYear()}}">1 Year</option>
								<option value="{{$carbon->addYears(5)}}">5 Years</option>
							</optgroup>							
						</select>
					</div>
				</div>
				<div class="form-group">
				<label class="col-sm-2 control-label" for="reason">Reason</label>
				<div class="col-md-4 col-sm-6">
				<textarea rows="3" name="reason" placeholder="Reason" class="form-control" required="on"></textarea>
				<br>
				<button type="submit" class="btn btn-default">
				Ban 
				</button>
				</div>
				</div>
			</form>
		</div>
		</div>
	</div>
</div>
</div>
</div>
<!-- <section class="content">
</section> -->


@include('Admin.footer')