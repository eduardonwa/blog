<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag; 
use App\Models\Category;
use App\Models\CustomComment;
use App\Models\Post;
use App\Models\About;

class HomeController extends Controller
{
    public function index()
    {   
        $post = Post::latest()->take(13)->get();
        $category = Category::all();
        $about = About::take(1)->latest()->get();
        $tag = Tag::take(5)->latest()->get();

        return view('/dashboard', [
            'posts' => $post,
            'category' => $category,
            'about' => $about,
            'tag' => $tag
            ]);
    }
}
