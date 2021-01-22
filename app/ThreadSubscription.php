<?php

namespace App;

use App\Notifications\ThreadWasUpdated;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

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
       return $this->user->notify(new ThreadWasUpdated($this->thread, $reply));
   }

   public function sameReplyId($reply)
   {
      return $this->user_id != $reply->user_id;
   }
}
