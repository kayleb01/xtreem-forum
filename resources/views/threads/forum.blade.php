 @extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        {{($threads[0]->category->name)}}
    </div>
    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ol class="breadcrumb">
                       <li><a href="/">Home</a></li>
                       <li><a href="#">{{($threads[0]->category->name)}}</a></li>
                       <li><a href="#">{{$threads[0]->forum->name}}</a></li>
                    </ol>
                    <span class="btn btn-primary" style="margin: 7px; " ><a  style=" color: #fff;" href="/forum/{{$threads[0]->forum->id}}/create">Create New Topic</a></span>
                                            <br>
                </div> 
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="padding: 0">
                        @foreach($threads as $thread)
                    	<div class="panel-body bk" style="padding:6px; border: none;"><img class="image-circle" src="/storage/storage/img/{{$thread->user->image_url}}">
                    			<span class="title">
                                    <!-- The thread section -->
                    				&nbsp;&nbsp;<a href="/{{$thread->slug}}">{{$thread->title}}</a>
                    			</span>
                    				<span class="details">
                                        <!-- Print out the User details -->
                    				 Posted by  <a href="/user/{{$thread->user->username}}">{{$thread->user->username}}</a>
                                     <span class="c"><i class="fa fa-comment"></i>&nbsp;{{$thread->replies_count}} {{Str::plural('comment', $thread->replies_count)}}</span>&nbsp;&nbsp;<span class="v">&nbsp;{{$thread->visits}} {{Str::plural('view', $thread->visits)}}</span>&nbsp;&nbsp;<span class="tm">published on {{$thread->created_at->diffForHumans()}}</span>              				
                    				</span>
                    		</div>
                    	@endforeach
                    	</div>
        			</div>
        	   </div>
               {!!$threads->links()!!}	
                @include('threads._partials.widget')		
             </div>					
            			
    </div>  
</div>      
@endsection
