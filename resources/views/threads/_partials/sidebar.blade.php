<aside>
    @if (count($trending))
        <div class="widget">
            <h4 class="widget-heading">Trending</h4>

            <ul class="list-reset">
                @foreach ($trending as $thread)
                    <li class="pb-3 text-sm">
                        <a href="{{ url($thread->path) }}" class="link text-blue">
                            {{ $thread->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
</aside>
