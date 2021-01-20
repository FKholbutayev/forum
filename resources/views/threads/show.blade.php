@extends('layouts.app')

@section('content')
    <thread-view :initial-replies-count="{{$thread->replies_count}}"
                 v-slot="{repliesCount,increaseCount, decreaseCount}">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-white">
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
                    <replies @added="increaseCount" @remove="decreaseCount"></replies>
                </div>

                <div class="col-md-4">
                    <div class="card p-4">
                        <p>
                            This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }}</a>, and currently
                            has <span v-text="repliesCount"></span> comments
                        </p>
                        <p>
                            <subscribe-button :active="{{json_encode($thread->isSubscribedTo)}}"></subscribe-button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </thread-view>

@endsection
