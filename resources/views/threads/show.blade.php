@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
            <div class="card-header">
                created by
                <strong>{{ $thread->creator->name }}</strong>
                {{ $thread->title }}
            </div>

                <div class="card-body">
                        {{ $thread->body }}
                </div>
            </div>
            @foreach ($thread->replies as $reply)
                <div class="card mt-4">
                    @include('threads.reply')
                </div>
            @endforeach

            {{ $replies->links() }}

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
                        has {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}.
                    </p>
                </div>
        </div>
    </div>





</div>
@endsection
