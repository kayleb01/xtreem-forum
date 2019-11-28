@extends('layouts.app')
@section('content')
<div class="container">
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
                       <li><a href="#">{{$forum->category->name}}</a></li>
                       <li><a href="#">{{$forum->name}}</a></li>
                    </ol>
                   
                </div> 
                    <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12 panel panel-default"  style="padding: 5px">
                       
                        <div class="panel panel-body " style="padding: 5px">
                            <form action="{{route('xf/store')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                               <div class="col-sm-10">
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                            <ul>
                                                <li><h4 style="color: red">Rules</h4></li>
                                                <li>Please do not spam</li>
                                                <li>Fake information will be taken down</li>
                                                <li>Don't insult any member or Admin nor Mod</li>
                                                <li></li>
                                            </ul><br>
                                            <label class="col-sm-2 control-label" for="email">Title</label>
                                            <div class="col-sm-10">
                                                <input  name="title" placeholder="Enter a Title" maxlength="150" class="form-control " type="text">
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
                                                    <textarea class="body textarea" name="body" maxlength="2000" rows="8" cols="90">
                                                    </textarea><br>
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
                                            <button type="submit" class="f btn btn-primary">
                                            Create
                                            </button><br>
                                  

                                     </div> 
                                 </div>
                                
                            </form>
                        </div>
                        
                    </div>
              </div>
            </div>          
        </div>   
         @include('threads._partials.widget')
    </div>              
</div>        

@endsection
