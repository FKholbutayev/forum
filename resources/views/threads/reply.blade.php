<div class="card-header">
    <a href="#"> {{$reply->owner->name}} </a> said
    {{ $reply->created_at->diffForHumans() }} ago
</div>

<div class="card-body">
    {{ $reply->body }}
</div>
