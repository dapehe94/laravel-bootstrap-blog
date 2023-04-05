<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

class ControllerByRouteName
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $slug): Response
    {
        if ($request->route()->named('post.show')) {

            // recuerda poner static en el controller
            return PostController::show($request);            

        }

        if ($request->route()->named('category.show')) {

            return CategoryController::show($slug);

        }

        if ($request->route()->named('tag.show')) {

            return TagController::show($slug);

        }

        return $next($request);
    }
}