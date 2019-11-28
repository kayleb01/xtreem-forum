
<div class="container no-gutters">
    <div class="row no-gutters">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
            <div class="card mb-3 no-gutters">
                <div class="forums collapsein"> 
                  <table class="table vertical-align" cellspacing="5" style="color: #ccc;">
                    @foreach($errors as $cater)
                      <tr>
                          <td>
                            <legend style="padding: 5px;">{{$cater->name}}</legend>
                              @foreach($cater->forums as $forum)
                              {{$loop->first?'':''}}
                              <span class="focuz">
                                <a href="/forum/{{$forum->slug}}" title="{{$forum->description}}" class="btn btn-xtrm" style="text-decoration: none;">{!! $forum->name!!}</a> 
                              </span>
                               @endforeach
                          
                          </td>
                       </tr>
                    @endforeach    
                  </table>    
                </div>
                      <!-- </div> -->
                      <!-- endrow</div> -->
                    </div> 
                       <div class="" style="margin-top: -15px">
                                  <!-- <div class="col-lg-9 f col-sm-12 col-md-9 col-xs-12 no-gutters"> -->
                                    <div class="container-fluid" style="font-size: 10pt">
                                    <div class="tab nav-tabs">
                                      <button class="tablinks" id="default" onclick="openTab(event, 'feat')">Featured</button>
                                      <button class="tablinks" onclick="openTab(event, 'trend')">Trending
                                      </button>
                                    </div>
                                     <div class="tabcontent" id="feat">
                                  @if(isset($getFeatured))
                                        @foreach($getFeatured as $key => $featured)
                                        @if($key++ % 9 == 1)
                                       <div class='heading pt-0' style='text-align: center;'> <a href='/register'>Register</a> and <a href='/login'>Login</a> to join our community</div>
                                       @endif
                                    <div class="forum_title">
                                        <img class="image-circle" src="/storage/storage/img/{{$featured->user->avatar ? $featured->user->avatar : 'default.png'}}">
                                        <div class="featured">
                                            <a href="/{{$featured->slug}}">{{$featured->title}} </a><br>
                                            <span class="c"><i class="fa fa-comment"></i>&nbsp;{{$featured->replies_count}} {{Str::plural('comment', $featured->replies_count)}}</span>&nbsp;&nbsp;<span class="v">&nbsp;{{$featured->visits}} {{Str::plural('view', $featured->visits)}}</span>&nbsp;&nbsp;<span class="tm">published {{$featured->created_at->diffForHumans()}}</span>
                                        </div>
                                  </div>
                                        @endforeach
                                    
                                        {!!$getFeatured->links()!!}
                                        @endif
                                </div> 
                                    <div class="tabcontent" id="trend">
                                     @if(!empty($trending))
                                         @foreach($trending as $trend)
                                        <div class="forum_trend">
                                          <div class="featured">
                                           <a href="{{$trend->path}}">
                                             {{$trend->title}}
                                           </a>
                                           <span class="tm">Posted by {{$trend->creator}} In <a href="/forum/{{$trend->forum}}">{{$trend->forum}}</a> </span>
                                         </div>
                                        </div>
                                       @endforeach
                                      @endif
                                    </div>
                                  </div>
                                <!-- </div> -->
                                 <!-- widget -->
                                @include('threads._partials.widget')
                              </div>                              
                </div>
            </div>
        </div>