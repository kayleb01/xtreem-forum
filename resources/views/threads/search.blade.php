@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row"><br>
                <div class="col-md-9 col-lg-9 col-sm-12 col-xs-12">
                @if($threads->count()> 0)
                  @foreach($threads as $search)
                  <div class="panel-heading"><a href="/xf/{{$search->thread->slug}}">{{$search->thread->title}}</a></div>
                  <div class="panel-body">
                    <div class="thread-content">
                      {!!$search->body!!}
                    </div>
                  </div>
                  @endforeach
                @else
                <div class="panel-body" style="padding: 20px;"><h3 > SORRY! WHAT YOU ARE LOOKING FOR WAS NOT FOUND</h3></div>
                @endif
                </div>

                <div class="col-md-3">
                    <div class="panel">
                        <div class="panel-heading">
                            Search
                        </div>

                        <div class="panel-body">
                            <ais-search-box>
                                <ais-input placeholder="Find a thread..." :autofocus="true" class="form-control"></ais-input>
                            </ais-search-box>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            Filter By Channel
                        </div>

                        <div class="panel-body">
                            <ais-refinement-list attribute-name="channel.name"></ais-refinement-list>
                        </div>
                    </div>

                    @if (count($trending))
                        <div class="panel">
                            <div class="panel-heading">
                                Trending Threads
                            </div>

                            <div class="panel-body widget">
                                <ul class="list-group">
                                    @foreach ($trending as $thread)
                                        <li class="list-group-item">
                                            <a href="{{ url($thread->path) }}">
                                                {{ $thread->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </ais-index>
        </div>
    </div>
@endsection
