@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
    @include('threads._partials.widget')
        <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
            <div class="">
                <div class="">
                    <ol class="breadcrumb shadow-sm" style="margin-bottom:6px !important">
                       <li class="breadcrumb-item"><a href="/">Home</a></li>
                       <li class="breadcrumb-item"><a href="#">{{$thread->category->name}}</a></li>
                       <li class="breadcrumb-item"><a href="#">{{$thread->title}}</a></li>
                    </ol>
                </div>
                        <div class="panel panel-body " style="padding: 5px">
                            <form action="{{url('/thread/'.$thread->id.'/edit')}}" method="POST" class="form-horizontal" enctype="multipart/form-data">
                               <div class="col-sm-10">
                                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                            <ul>
                                                <li><h4 style="color: red">Rules</h4></li>
                                                <li>Please do not spam</li>
                                                <li>Fake information will be removed</li>
                                                <li>Don't insult any member or Admin nor Mod</li>
                                                <li></li>
                                            </ul><br>
                                            <label class="col-sm-2 control-label" for="email">Title</label>
                                            <div class="col-sm-10">
                                                <input  name="title" placeholder="Enter a Title" maxlength="150" class="form-control " type="text" value="{{$thread->title}}">
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
                                                    <textarea name="body" class="mb-4 form-control w-full text-md rounded mt-3 p-2 resize-none outline">{{$thread->body}}
                                                        </textarea>
                                                @if($thread->attachment)
                                                  @foreach( $thread->attachment as $attached)
                                                    {{$attached->filename}}<br>
                                                  @endforeach
                                                @endif
                                                    <span>Image Upload -  Only Four files allowed, not more than 4mb</span>
                                                 <input type="file" name="file[]" id="file" class="form-control" multiple>
                                                  <br>
                                                </div>
                                                {{csrf_field()}}
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-2">
                                            <button type="submit" class="f btn btn-secondary btn-block">
                                            Update
                                            </button><br>


                                     </div>
                                 </div>

                            </form>
                        </div>


              </div>
            </div>

        </div>

    </div>
</div>

@endsection
