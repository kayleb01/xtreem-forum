@extends('layouts.app')
@section('content')
<div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ol class="breadcrumb">
                       <li><a href="/">Home</a></li>
                       
                    </ol>
                    <a  style=" color: #fff;" href="/forum/{{$threads}}/create"><span class="btn btn-primary" style="margin: 7px; " >Create New Topic</span></a>
                                            <br>
                </div> 
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 panel panel-default" style="padding: 0">
                       <center><h3>This Category Contains <b>NO Thread</b> Please Create New Thread</h3></center> 
                    	</div>
        			</div>
        	</div>			
        </div>					
    </div>    			
</div>        
@endsection
