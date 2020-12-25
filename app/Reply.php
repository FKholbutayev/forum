<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Favorite;

class Reply extends Model {

    protected $guarded = [];
    protected $with = ['owner', 'favorites'];
    use Favoritable;

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
