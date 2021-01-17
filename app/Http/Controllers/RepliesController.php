<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Reply;
use http\Env\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use App\Thread;
use Illuminate\Validation\ValidationException;

class RepliesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(2);
    }

    public function store($channelId, Thread $thread) {

        try {
            $this->validate(request(), [
                'body' => 'required'
            ]);
        } catch (ValidationException $e) {
            return $e->getMessage();
        }

        $reply = $thread->addReply([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        if (\request()->expectsJson()) {
            return $reply->load('owner');
        }

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
