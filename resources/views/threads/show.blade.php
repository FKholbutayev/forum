@extends('layouts.app')

@section('content')
<thread-view :initial-replies-count="{{$thread->replies_count}}" v-slot="{repliesCount, decreaseCount}">
    <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                <div class="level">
                    <span class="flex">
                        <a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}

                    </span>

                    @can('update', $thread)
                    <form action="{{ $thread->path() }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-link">Delete thread</button>
                    </form>
                    @endcan

                </div>
            </div>

                <div class="card-body">
                        {{ $thread->body }}
                </div>
            </div>
            <replies @remove="decreaseCount" :data="{{ $thread->replies }}"></replies>

            @if(auth()->check())
                <form method="POST" action="{{ route('reply.store', [$thread->channel->id, $thread->id]) }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control mt-4"
                                  placeholder="Have something to say" rows="5">
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
            @else
                <p class="text-center"> <a href="{{route('login')}}">Sign in</a> in to comment</p>
            @endif
        </div>

        <div class="col-md-4">
                <div class="card p-4">
                    <p>
                        This thread was published {{ $thread->created_at->diffForHumans() }} by
                        <a href="#">{{ $thread->creator->name }}</a>, and currently
                        has <span v-text="repliesCount"></span> comments
                    </p>
                </div>
        </div>
    </div>
    </div>
</thread-view>

@endsection
