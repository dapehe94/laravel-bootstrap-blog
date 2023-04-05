<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Builder;
use App\Enums\PostStatus;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->withCount([
            'comments' => function (Builder $query) {
                $query->where('approved', true);
            },
        ])->with(["author","categories","tags"])->get();

        return Inertia::render('Dashboard/Post/index',[
            'posts' => $posts
        ]);         
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status = PostStatus::cases();

        $poststatus = array_map(function ($post) {
            return [
                'id'    => $post->value,
                'value' => $post->value
            ];
        }, $status);

        $categories = Category::get()->map(function($category) {
            return [
                'id'    => $category->id,
                'value' => $category->name
            ];
        })->all();

        $tags = Tag::get()->map(function($tag) {
            return [
                'text' => $tag->name
            ];
        })->all();
        
        return Inertia::render('Dashboard/Post/create',[
            'poststatus' => $poststatus,
            'categories' => $categories,
            'tags' => $tags
        ]);      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {

        //dd($request->all());

        $post = new Post;

        $post->title = $request->title;
        $post->content = $request->content;
        $post->excerpt = $request->excerpt;
        $post->user_id = Auth::id();
        $post->status = $request->status;
        $post->save();

        $post->categories()->sync($request->categories);

        foreach($request->tags as $tag) {

            $checkTag = Tag::where('name', $tag)->first();

            if(!$checkTag) {

                $newTag = Tag::create(['name' => $tag]);
                $post->tags()->attach($newTag->id);

            } else {

                $post->tags()->attach($checkTag->id);
            }
        }

        return Redirect::route('post.index');         
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        //$post = Post::where('id', $post->id)->with('categories','tags')->firstOrFail();

        $post = Post::where('id', $post->id)
            ->with([
                'categories' => function ($query) {
                    $query->select('categories.id', 'name');
                },
                'tags' => function ($query) {
                    $query->select('name');
                },                
            ])->firstOrFail();        

        $status = PostStatus::cases();

        $poststatus = array_map(function ($post) {
            return [
                'id'    => $post->value,
                'value' => $post->value
            ];
        }, $status);

        $categories = Category::get()->map(function($category) {
            return [
                'id'    => $category->id,
                'value' => $category->name
            ];
        })->all();

        $tags = Tag::get()->map(function($tag) {
            return [
                'text' => $tag->name
            ];
        })->all();
        
        return Inertia::render('Dashboard/Post/edit',[
            'post' => $post,
            'poststatus' => $poststatus,
            'categories' => $categories,
            'tags' => $tags
        ]);         
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {

        $post->title = $request->title;
        $post->content = $request->content;
        $post->excerpt = $request->excerpt;
        $post->user_id = Auth::id();
        $post->status = $request->status;
        $post->save();

        $post->categories()->detach();

        $post->categories()->attach($request->categories);

        $post->tags()->detach();

        foreach($request->tags as $tag) {

            $checkTag = Tag::where('name', $tag)->first();

            if(!$checkTag) {

                $newTag = Tag::create(['name' => $tag]);
                $post->tags()->attach($newTag->id);

            } else {

                $post->tags()->attach($checkTag->id);
            }
        }

        return Redirect::route('post.index')->with('message', 'Post Updated Successfully');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach();
        $post->categories()->detach();
        $post->delete();
    }
}
