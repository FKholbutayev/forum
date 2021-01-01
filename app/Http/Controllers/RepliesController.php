<?php

namespace App\Http\Controllers;

use App\Reply;
use http\Env\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Thread;

class RepliesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($channelId, Thread $thread) {

        $this->validate(request(), [
            'body' => 'required'
        ]);

        $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
            'channel_id' => $channelId,
        ]);

        return redirect($thread->path())->with('flash', 'Your reply has been submitted');
    }

    public function destroy(Reply $reply)
    {
        try {
            $this->authorize('update', $reply);
        } catch (AuthorizationException $e) {
            return response()->json('Authorization failed', 'failure');
        }

        try {
            $reply->delete();
        } catch (\Exception $e) {
            return response()->json('failure', 'failure');
        }

        if (\request()->expectsJson())
        {
            return response()->json(['success' => 'Reply has been deleted']);
        }

        return back();
    }

    public function update(Reply $reply)
    {
        try {
            $this->authorize('update', $reply);
        } catch (AuthorizationException $e) {
            return response()->json('Authorization failed', 'failure');
        }

        $reply->update(["body" => request('body')]);
    }
}
