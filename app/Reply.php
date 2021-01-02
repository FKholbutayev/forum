<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;

class Reply extends Model {

    protected $guarded = [];
    protected $with = ['owner', 'favorites'];
    protected $appends = ['favoritesCount', 'isFavorited'];


    use Favoritable, RecordsActivity;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function path()
    {
        return $this->thread->path() ."#reply-{$this->id}";
    }

}
