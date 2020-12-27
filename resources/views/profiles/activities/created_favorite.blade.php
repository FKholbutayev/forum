@component('profiles.activities.activity')
    @slot('heading')
        <a href="{{ $activity->subject->favorited->path() }}"> favorited a reply
            {{ $profileUser->name }}
        </a>
    @endslot

    @slot('body')
        {{ $activity->subject->favorited->body }}

    @endslot
@endcomponent

