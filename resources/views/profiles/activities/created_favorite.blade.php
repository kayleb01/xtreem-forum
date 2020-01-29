@component('profiles.activities.activity')
    @slot('heading')
        <a href="{{ $activity->subject->favorited->path() }}">
            {{ $profileUser->username }} liked a reply.
        </a>
    @endslot

    @slot('body')
        {!! $activity->subject->liked->body !!}
    @endslot
@endcomponent
