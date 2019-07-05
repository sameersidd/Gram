<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    public function view($user)
    {
        $user = User::findorFail($user);
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postCount = Cache::remember(
            'posts.count' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            }
        );
        $followersCount = Cache::remember(
            'followers.count' . $user->id,
            now()->addSeconds(3),
            function () use ($user) {
                return $user->profile->followers->count();
            }
        );
        $followingCount = Cache::remember(
            'followers.count' . $user->id,
            now()->addSeconds(3),
            function () use ($user) {
                return $user->following->count();
            }
        );
        return view('profiles/index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit($user)
    {
        $user = User::findorFail($user);
        $this->authorize('update', $user->profile);
        return view('profiles/edit')->with('user', $user);
    }

    public function update($user)
    {
        $data = request()->validate([
            'Name' => ['required', 'max:15'],
            'description' => '',
            'url' => 'url',
            'img' => 'image'
        ]);
        $user = User::findorFail($user);

        $this->authorize('update', $user->profile);

        if (request('img')) {
            $path = request('img')->store('profiles', 'public');
            $data = array_merge(
                $data,
                ['img' => $path]
            );
        }
        auth()->user()->profile->update($data);

        return redirect("/u/{$user->id}");
    }
}
