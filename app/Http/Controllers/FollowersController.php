<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowersController extends Controller
{
    public function __constructor()
    {
        $this->middleware('auth');
    }
    public function follow(User $user)
    {
        if (auth()->user() === null)
            return response('Not Logged In!', 401);
        return auth()->user()->following()->toggle($user->profile);
    }
}
