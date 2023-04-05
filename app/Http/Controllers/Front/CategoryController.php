<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\Category;

use Inertia\Inertia;
use Inertia\Response;

class CategoryController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $posts = $category->posts()->publish()->get();

        return Inertia::render('Front/Category/show',[
            'category' => $category,
            'posts' => $posts
        ]);  
    }

}
