<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\Tag;

use Inertia\Inertia;
use Inertia\Response;

class TagController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $posts = $tag->posts()->publish()->get();

        return Inertia::render('Front/Tag/show',[
            'tag' => $tag,
            'posts' => $posts
        ]);         
    }

}
