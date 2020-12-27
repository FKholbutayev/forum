<script type="text/html" id="reply-template">

    <div id="reply-{{$reply->id}}" class="card-header">
    <div class="level">

        <h5 class="flex">
            <a href="/profiles/{{ $reply->owner->name }}">
            {{$reply->owner->name}}
            </a> said
            {{ $reply->created_at->diffForHumans() }} ago
        </h5>


    <div>
        <form action="/replies/{{ $reply->id }}/favorites" method="POST">
            {{ csrf_field() }}

            <button type="submit" class="btn btn-outline-secondary" {{ $reply->isFavorited() ? 'disabled' : '' }}>
               {{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
            </button>
        </form>
    </div>
    </div>
    </div>

<div class="card-body">
    {{ $reply->body }}
</div>

@can('update', $reply)
<div class="card-footer level mr-1">
    <button type="submit" class="btn btn-primary btn-sm">Edit</button>

    <form method="POST" action="/replies/{{ $reply->id }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
</div>
@endcan

</script>
