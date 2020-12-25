<?php

namespace App\Http\Controllers;

use http\Env\Url;
use Illuminate\Http\Request;

class ProfilesController extends Controller
{

    public function show()
    {
        return view('profiles.show');
    }
}
