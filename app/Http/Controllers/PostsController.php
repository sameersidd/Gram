<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{

    //Authentication Middleware
    //Ensures only authenticated can use this
    public function __construct() {
        $this->middleware('auth');
    }

    //view(App\Post $post)
    function view($post)
    {
        $post = Post::find($post);
        return view('posts/view')->with('post', $post);
    }

    function create()
    {
        return view('posts/create');
    }

    function store(Request $request)
    {
        $data = $request->validate([
            'caption' => 'required',
            'img' => ['required','image'],
        ]);

        $path = request('img')->store('uploads', 'public');

        //Create 1200x1200 images using Intervention Lib
        // $image = Image::make(public_path('/storage/{$path}'))->fit(1200,1200);
        // $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'img' => $path
        ]);


            return redirect('/u/1');
    }
}
