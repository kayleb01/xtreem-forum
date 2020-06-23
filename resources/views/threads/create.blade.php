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
                    
                    <ol class="breadcrumb shadow-sm" style="margin-bottom:6px !important">
                       <li class="breadcrumb-item"><a href="/">Home</a></li>
                       <li class="breadcrumb-item"><a href="/forum/{{$forum->slug}}">{{$forum->name}}</a></li>
                       
                    </ol>
                   
                </div> 
                        <div class="panel panel-body " style="padding: 5px">
                            <form action="{{route('xf/store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                               <div class="col-sm-10">
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                            <ul>
                                                <li><h4 style="color: red">Rules</h4></li>
                                                <li>Please do not spam</li>
                                                <li>False information will be removed</li>
                                                <li>Don't insult any member or Admin nor Mod</li>
                                                <li>Don't advertise commercial content, product or services in any way. You may offer suggestions for products or services but do not start a thread for them</li>
                                                <li>Admin and Moderators may modify or remove your content at any time without prior notice</li>
                                                <li><b>These rules may change at any given time without prior notice</b></li>
                                            </ul><br>
                                            <label class="col-sm-2 control-label" for="email">Title</label>
                                            <div class="col-sm-10">
                                                <input  name="title" placeholder="Enter a Title" maxlength="150" class=" rounded-pill form-control " type="text" required>
                                            </div>
                                             @if ($errors->has('title'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                             @endif
                                        </div>
                                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                             @if ($errors->has('body'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('body') }}</strong>
                                                </span>
                                             @endif  
                                            <label class="col-sm-2 control-label" for="body">Body</label>
                                                <div class="col-sm-10">
                                                    <wysiwyg class="body" name="body" maxlength="2000">
                                                    </wysiwyg><br>
                                                    <span>Image Upload -  Only Four files allowed, not more than 4mb</span>
                                                 <input type="file" name="file[]" id="file" class="form-control" multiple>
                                                  <br>
                                                </div>
                                                <input type="hidden" name="forum_id" value="{{$forum->id}}">
                                                <input type="hidden" name="_method" value="put">
                                                <input type="hidden" name="category_id" value="{{$forum->category->id}}">
                                                {{csrf_field()}}
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <button type="submit" class=" mb-3 btn btn-secondary btn-block rounded-pill">
                                            Create
                                            </button><br>
                                     </div> 
                                 </div>
                            </form>
                        </div>
              </div>
            </div>          
             @include('threads._partials.widget')
        </div>  
    </div>              
</div>        

@endsection
