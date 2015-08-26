<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::whereParentId(1)->with('posts','fourPosts')->get();
        return view('posts.index', with(compact('categories')));
    }

    public function unionAll(Category $category)
    {
        $categories = $category->whereParentId(1)->get();

        $query = null;

        foreach($categories as $category) {
            if (!$query) {
                $query = Post::where('category_id', $category->id);
                continue;
            }

            $query->unionAll(function($q) use ($category) {
                $q->where('category_id', $category->id)->take(4);
            });
        }

        $posts = $query->get()->groupBy('category_id');

        foreach ($categories as $category) {
            $categoryPosts = isset($posts[$category->id]) ? $posts[$category->id] : collect([]);
            $category->setRelation('posts', $categoryPosts);
        }
        dd($categories);
        return view('posts.index')->with(compact('categories'));
    }
}
