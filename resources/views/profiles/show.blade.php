@extends('layouts.app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
			 <activities :user="{{ $profileUser }}"></activities>
		</div>
			@include('threads._partials.widget')
	</div>
	
</div>
   
@endsection
