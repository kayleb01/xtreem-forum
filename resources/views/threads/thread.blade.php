                        <subscribe-button
                            :threads="@json($thread->id)"
                            :active="{{ json_encode($thread->isSubscribedTo) }}"
                            v-if="signedIn"
                        >
                        </subscribe-button>

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
                            <div class="thread-use bg-light">
                             <table  style="margin-bottom: 0;border-radius: 0;">
                                  <tr>
                                    <td style="max-width:350px;">
                                      <a href="/u/{{$thread->user->username}}">
                                        <img src="{{$thread->user->avatar? $thread->user->avatar : 'default.jpg'}}" class="image-circle responsive">
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

                            <div class="thread-body bg-light">
                              {!!$thread->body!!}
                              @if(count($thread->media) > 0)
                                <div class="row no-gutters ">
                                    @if (count($thread->media) > 1)
                                        @foreach($thread->media as $media)
                                            <div class="col-6 p-2 img-container" >
                                                <a href="{{url('/storage/media')}}/{{$media->filename}}"  data-lightbox="image">
                                                    <img class="attachment rounded-xl"
                                                        src="{{url('/storage/media')}}/{{$media->filename}}"
                                                        style="object-fit: cover; width:100%; height:200px;"
                                                    />
                                                </a>
                                            </div>

                                        @endforeach
                                    @else
                                        <div class="col-12">
                                            @foreach($thread->media as $media)
                                                <div class="col-12 p-2">
                                                    <img class="attachment rounded-xl" src="{{url('/storage/media')}}/{{$media->filename}}"/>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                              @endif

                              <div class="">
                                <thread-rx :thread='@json($thread)' ></thread-rx>
                            </div>

                            </div>                        <!-- this is the comment section -->
                         @section('scripts')
                         <script type="text/javascript" src="{{asset('js/lightbox-plus-jquery.min.js')}}">
                         </script>
                        <script>
                            window.onload = () => {
                                let link = document.createElement("link");
                                link.rel = "stylesheet";
                                link.href = "/css/lightbox.min.css";
                                document.getElementsByTagName('head')[0].appendChild(link);

                            }
                            lightbox.option({
                            'resizeDuration': 200,
                            'wrapAround': true,
                            'disableScrolling':true
                            })
                        </script>
                         @endsection
