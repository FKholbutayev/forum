<?php

namespace App;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Model;

class ThreadSubscription extends Model
{
   protected $guarded = [];

   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function thread()
   {
       return $this->belongsTo(Thread::class);
   }

   public function notify($reply)
   {
       dd("coming here");
        $this->user->notify(new ThreadWasUpdated($this, $reply));
   }

   public function forReply($reply)
   {
       $this->user_id != $reply->user_id;
   }
}
