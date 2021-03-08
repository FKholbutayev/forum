@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @forelse($threads as $thread)

                    <div class="card mt-4 bg-white">
                        <article>
                            <div class="level card-header bg-white">
                                <h4 class="flex">
                                    <a href="{{ $thread->path() }}">

                                        @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                            <strong>
                                                {{ $thread->title }}
                                            </strong>
                                        @else

                                        {{ $thread->title }}

                                        @endif
                                    </a>
                                </h4>

                                <a href="{{ $thread->path() }}">
                                    {{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}
                                </a>
                            </div>
                            <div class="card-body">{{ $thread->body }}</div>
                        </article>

                    </div>
                @empty
                    <p>There are no relevant records</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
