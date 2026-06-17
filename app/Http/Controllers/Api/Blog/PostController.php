<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Http\Resources\Api\Blog\Admin\PostResource;

class PostController extends BaseController{

    public function index()
    {
        $items = BlogPost::all();


        return $items;
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        $item = BlogPost::where('is_published', true)->findOrFail($id);

        return new PostResource($item);
    }


    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
