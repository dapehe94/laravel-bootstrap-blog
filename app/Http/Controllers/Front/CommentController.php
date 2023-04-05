<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

use Inertia\Inertia;
use Inertia\Response;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentRequest $request)
    {
        $post = Comment::create($request->all());       
    }

}