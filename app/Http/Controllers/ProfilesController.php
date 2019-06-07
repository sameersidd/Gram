<?php

namespace App\Http\Controllers;
use App\User;

use Illuminate\Http\Request;

class ProfilesController extends Controller
{
    public function view($user)
    {
        $user = User::findorFail($user);
        return view('profiles/index')->with('user', $user);
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
            'Name' => ['required','max:15'],
            'description' => '',
            'url' => 'url',
            'img' => 'image'
        ]);
       $user = User::findorFail($user);

       $this->authorize('update', $user->profile);

       if(request('img')){
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
