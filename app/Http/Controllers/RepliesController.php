<?php

namespace App\Http\Controllers;

use App\Inspection\Spam;
use App\Reply;
use Illuminate\Auth\Access\AuthorizationException;
use App\Thread;
use Illuminate\Validation\ValidationException;

class RepliesController extends Controller {

    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    public function index($channelId, Thread $thread)
    {
        return $thread->replies()->paginate(10);
    }

    public function store($channelId, Thread $thread, Spam $spam) {

        try {
            $this->validate(request(), [
                'body' => 'required'
            ]);

            $spam->detect(request('body'));

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
