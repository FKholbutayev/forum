<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use http\Env\Url;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public function show(User $user)
    {
        $activities = Activity::feed($user);

        return view('profiles.show', [
            'profileUser' => $user,
            'activities' => $activities
        ]);
    }

}
