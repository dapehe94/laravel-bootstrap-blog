<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\Post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {

        $auth_user_id = Auth::id();

        $post = Post::where('slug', $slug)->publish()->withCount([
            'comments' => function (Builder $query) {
                $query->where('approved', true);
            },
        ])->firstOrFail();

        $comments_approved = $post->comments()->with('author')->approved()->get();
        $comments_user_no_approved = $post->comments()->where('user_id', $auth_user_id)->with('author')->get();
        $comments = $comments_approved->merge($comments_user_no_approved);

        $categories = $post->categories()->get();
        $tags = $post->tags()->get();

        return Inertia::render('Front/Post/show',[
            'post' => $post,
            'comments' => $comments->all(),
            'categories' => $categories,
            'tags' => $tags
        ]);         
    }

}
