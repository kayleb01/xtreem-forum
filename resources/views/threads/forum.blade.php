 @extends('layouts.app')

@section('content')

<div class="container">
    <div class="jumbotron bg-img mt-2 text-light" style="height: 108px !important;">
                {{$threads[0]->forum->name}}<br>
                {{$threads[0]->forum->description}}
                <a href="#" class="btn btn-secondary float-right rounded">Follow</a>
   </div>
    <div class="row">
        <!-- SideWidget -->
        @include('threads._partials.widget')
        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
            <a   class="btn btn-secondary rounded-pill mb-2 text-light" style=" color: #fff;" href="/forum/{{$threads[0]->forum->id}}/create">
                <span style="margin: 7px;">Create New Topic</span></a>
                                            <br>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12" style="padding: 0">
                        @foreach($threads as $thread)
                    	<div class="panel-body bk" style="padding:6px; border: none;"><a href="/u/{{$thread->user->username}}"><img class="image-circle" src="/storage/img/{{$thread->user->avatar? $thread->user->avatar : 'default.jpg'}}"></a>
                    			<span class="title">
                                    <!-- The thread section -->
                    				&nbsp;&nbsp;<a href="/{{$thread->slug}}" class="link">{{$thread->title}}</a>
                    			</span>
                    				<span class="details">
                                        <!-- Print out the User details -->
                    				 Posted by  <a href="/u/{{$thread->user->username}}" class="link">{{$thread->user->username}}</a>
                                     <span class="c"><i class="fa fa-comment"></i>&nbsp;{{$thread->replies_count}} {{Str::plural('comment', $thread->replies_count)}}</span>&nbsp;&nbsp;<span class="v">&nbsp;{{$thread->visits}} {{Str::plural('view', $thread->visits)}}</span>&nbsp;&nbsp;<span class="tm">published on {{$thread->created_at->diffForHumans()}}</span>
                    				</span>
                    		</div>
                    	@endforeach
                    	</div>
        			{!!$threads->links()!!}
        	   </div>

             </div>

    </div>
</div>
@endsection
