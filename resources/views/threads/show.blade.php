@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    @include('threads._partials.widget')
        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12"> 
            <ol class="breadcrumb shadow-sm" style="margin-bottom:6px !important">
               <li class="breadcrumb-item"><a href="/">Home</a></li>
               <li class="breadcrumb-item"><a href="/forum/{{$thread->forum->slug}}">{{$thread->forum->name}}</a></li>
               <li class="breadcrumb-item active">{{($thread->title)}} &sdot; <em>{{$thread->visits}}       {{Str::plural('views', $thread->visits)}}</em> 
                @if($thread->fp == 1)
                    <small class="bg-dark" style="padding:3px;border-radius:5px">Featured</small>
                @endif
               </li>
            </ol>
            <div>
                @include ('threads.thread')
                <replies @added="repliesCount++" @removed="repliesCount--"></replies>
            </div>
        </div>



    </div>
</div>
@endsection
