@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card">
            <div class="card-header">
                created by
                <strong>{{$thread->creator->name}}</strong>
                {{$thread->title}}
            </div>

                <div class="card-body">
                        {{$thread->body}}
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            @foreach ($thread->replies as $reply)
                <div class="card mt-2">
                    @include('threads.reply')
                </div>
            @endforeach
        </div>
    </div>

    @if(auth()->check())
    <div class="row justify-content-center mt-2">
        <div class="col-md-8 col-md-offset-2">
                <form method="POST" action="{{ route('reply.store', [$thread->channel->id, $thread->id]) }}">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" id="body" class="form-control"
                                  placeholder="Have something to say" rows="5">
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post</button>
                </form>
        </div>
    </div>
    @else
        <p class="text-center"> <a href="{{route('login')}}">Sign in</a> in to comment</p>
    @endif

</div>
@endsection
