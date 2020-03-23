 @extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
            <div class="">
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ol class="breadcrumb">
                       <li class="breadcrumb-item"><a href="/">Home</a></li>
                       <li class="breadcrumb-item">{{$users->username.'\'s Threads'}}</li>
                    </ol>
                </div> 
                    <div class="" style="padding: 0">
                        @foreach($threads as $thread)
                      <div class="panel-body" style="padding:6px; border: none;">
                        <img class="image-circle" src="/storage/storage/img/{{$thread->user->image_url}}">
                          <span class="title">
                                    <!-- The thread section -->
                            &nbsp;&nbsp;<a href="/xf/{{$thread->slug}}">{{$thread->title}}</a>
                          </span>
                            <span class="details">
                                        <!-- Print out the User details -->
                             Posted by  <a href="/user/{{$thread->user->username}}">{{$thread->user->username}}</a>
                                     <span class="tm"><i class="fa fa-comment"></i>&nbsp;{{$thread->replies_count}} {{Str::plural('comment', $thread->replies_count)}}</span>&nbsp;&nbsp;<span class="v">&nbsp;{{$thread->visits}} {{Str::plural('view', $thread->visits)}}</span>&nbsp;&nbsp;<span class="tm">published on {{$thread->created_at->diffForHumans()}}</span>                      
                            </span>
                        </div>
                      @endforeach
                      </div>
              </div>
              {!!$threads->links()!!}
             </div>
             @include('threads._partials.widget')     
             </div><!-- End of row -->
                   
       
     </div> 

                  
</div>

@endsection
