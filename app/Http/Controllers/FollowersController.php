<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowersController extends Controller
{
    public function follow(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
