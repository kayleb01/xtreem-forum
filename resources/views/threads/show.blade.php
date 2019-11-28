@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
            <!-- <div class="card"> -->
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <ol class="breadcrumb shadow-sm">
                       <li class="breadcrumb-item"><a href="/">Home</a></li>
                       <li class="breadcrumb-item"><a href="/forum/{{$thread->forum->slug}}">{{$thread->forum->name}}</a></li>
                       <li class="breadcrumb-item active">{{($thread->title)}} &sdot; <em>{{$thread->visits}}       {{Str::plural('views', $thread->visits)}}</em>
                       </li>
                    </ol>
         
        <div>
            <div class="py-3">
                @include ('threads.thread')

                <replies @added="repliesCount++" @removed="repliesCount--"></replies>
            </div>
        </div>
    
            </div>
        </div>
     @include('threads._partials.widget')

    </div>
</div>
@endsection
