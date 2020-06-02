@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form method="POST" action="/threads">
                        @csrf

                        <div class="form-group">
                            <label for="channel_id">Choose a channel</label>
                            <select name="channel_id" class="form-control" id="channel_id" required>
                                <option value="">Choose one ...</option>
                                @foreach ($channels as $channel)

                                    <option value="{{$channel->id}}"
                                            {{ old('channel_id' == $channel->id ? 'selected' : '')}}>
                                        {{$channel->name}}
                                    </option>

                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Title: </label>
                            <input type="text" class="form-control"
                                   name="title" id="title" placeholder="title" required value="{{old('title')}}"/>
                        </div>

                        <div class="form-group">
                            <label for="body">Body: </label>
                            <textarea name="body" class="form-control"
                                      id="body" required placeholder="Add description"
                                      rows="8">{{old('body')}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </div>
                        @include('errors')
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
