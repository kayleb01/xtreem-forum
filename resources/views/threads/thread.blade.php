
                                      <subscribe-button :threads='@json($thread->id)' :active="{{ json_encode($thread->isSubscribedTo) }}" v-if="signedIn"></subscribe-button>

                                      <div class="panel-heading rounded-top p-1">
                                       {{($thread->title)}}
                                        @if(Auth::check())
                                          @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                                        <div class="dropdown" style="display: inline-block">
                                          <a href="#" class="dropdown-toggle text-light" id="dropdownMenuButton" data-toggle="dropdown" role="menu" aria-expanded="false" aria-haspopup="true"> <i class="fa fa-toggle-on"></i> </a>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              @if($thread->locked == 0)
                                                <a href="{{url('/xf/lock',$thread->id)}}" class="dropdown-item">Lock thread</a>
                                              @else
                                                <a href="{{url('/xf/unlock',$thread->id)}}" class="dropdown-item">Unlock thread</a>
                                              @endif
                                              <a href="{{url('/xf/lock',$thread->id)}}" class="dropdown-item">Move thread</a>
                                              <a href="/xf/thread/{{$thread->id}}" class="dropdown-item" onclick="event.preventDefault();
                                                      document.getElementById('delete-form').submit();
                                                      ">
                                                      Delete thread
                                            </a>
                                              <form id="delete-form" action="{{ url('/xf/thread', $thread->id) }}" method="POST" style="display: none;">
                                              {{ csrf_field() }}
                                              {{ method_field('DELETE') }}
                                              </form>
                                            <a href="{{url('/xf/featured', $thread->id)}}" class="dropdown-item">Make FP</a>
                                          </div>
                                      </div>
                              @endif
                            @endif

                            </div>
                            <div class="thread-use">
                             <table  style="margin-bottom: 0;border-radius: 0;">
                                  <tr>
                                    <td style="max-width:350px;">
                                      <a href="/u/{{$thread->user->username}}">
                                        <img src="/storage/img/{{$thread->user->avatar? $thread->user->avatar : 'default.jpg'}}" class="image-circle responsive">
                                      </a>
                                      <span>
                                          <a href="/u/{{$thread->user->username}}" class="username">{{$thread->user->username}}</a>
                                        </span>
                                      &nbsp;&sdot;&nbsp;
                                      <span>
                                          {{$thread->created_at->toFormattedDateString()}}
                                      </span>
                                      <div class="timestamp" style="width: 400px">
                                        @if(Auth::check())
                                            @if(Auth::user()->role == 1 )
                                             &nbsp;
                                                <span class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    <span class="caret"></span>
                                                </span>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu">
                                                    <li class="p-2">
                                                        <a href="/moderation/{{$thread->user->id}}/ban">Ban User</a>
                                                    </li>
                                                </ul>
                                            @endif
                                      @endif
                                      </div>

                                    </td>
                                  </tr>
                                  </table>
                            </div>
                                  <hr style="margin: 0;">

                            <div class="thread-body">
                              {!!$thread->body!!}
                              @if(count($thread->media) > 0)
                                <div class="row no-gutters">
                                    @if (count($thread->media) > 1)
                                        @foreach($thread->media as $media)
                                            <div class="col-6 p-2"> <img class="attachment rounded-xl" src="{{url('/storage/media')}}/{{$media->filename}}"/></div>
                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            @foreach($thread->media as $media)
                                                <div class="col-12 p-2"> <img class="attachment rounded-xl" src="{{url('/storage/media')}}/{{$media->filename}}"/></div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                              @endif
                              <div class="lks">
                                        <a href="#" onclick="event.preventDefault(); actOnLikes('{{$thread->id}}', '/comment/like/{{$thread->id}}')" data-id="{{$thread->id}}" class="ikes">
                                          <i class="fa fa-thumbs-o-up" title="Like" ></i> <span id="ike_text{{$thread->id}}">{{Str::plural($thread->Isliked()?'Unlike':'Like', $thread->likess->count())}}</span>
                                        </a>
                                            <span class="Like-{{$thread->id}}">
                                              @if($thread->likess->count() > 0)
                                                  {{$thread->likess()->count()}}

                                                @endif
                                            </span>
                                        &nbsp;&nbsp;
                                        <a href="#" class="quote" data-id="{{$thread->id}}">
                                            <i class="fa fa-quote-right" title="Qoute"></i> Qoute
                                        </a>&nbsp;&nbsp;
                                        <a href="#">
                                            <i class=" fa fa-share-square" title="reply"></i> Reply</a>&nbsp;&nbsp;@if(!Auth::guest() && Auth::user()->id == $thread->user->id)
                                        <a href="/thread/{{$thread->id}}/edit" id="{{$thread->id}}">
                                            <i class=" fa fa-edit" title="Modify"></i> Modify
                                        </a>
                                        <a href="#" id="ave{{$thread->id}}" class="ave" style="display:none" data-id="{{$thread->id}}">
                                           <i class="fa fa-check"></i>Update
                                        </a>&nbsp;&nbsp;
                                        <a href="#" id="cancel{{$thread->id}}" class="cancel" style="display:none" data-id="{{$thread->id}}">
                                            <i class="fa fa-power-off" style="color: red;"></i> Cancel
                                        </a>
                                        <span id="cfa{{$thread->id}}"></span>
                                        @endif
                                      </div>
                            </div>
                         <!-- this is the comment section -->
