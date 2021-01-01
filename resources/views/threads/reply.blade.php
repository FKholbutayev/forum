<reply :attributes="{{ $reply }}" v-slot="{ editing, edit, body, cancel, updateBody }" v-cloak>
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
    <div v-if="editing">
        <div class="form-group">
           <textarea class="form-control" v-model="body"></textarea>
            <div class="mt-2">
                <button class="btn btn-sm btn-outline-primary" @click="updateBody(body)">Update</button>
                <button class="btn btn-sm btn-outline-primary mr-2" @click="cancel">Cancel</button>
            </div>
        </div>
    </div>
    <div v-else v-text="body"></div>
</div>

@can('update', $reply)
<div class="card-footer level mr-1">
    <button type="submit" class="btn btn-primary btn-sm" @click="edit">Edit</button>

    <form method="POST" action="/replies/{{ $reply->id }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
    </form>
</div>
@endcan
</reply>
