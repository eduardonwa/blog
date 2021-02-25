<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{   
    protected $dates = ['created_at'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $category)
    { 
    if (request('tag')) {
        $post = Tag::where('name', request('tag'))
                ->firstOrFail()
                ->posts()
                ->simplePaginate(8)
                ->withQueryString();
        
    } else {
        $post = Post::where('is_approved', true)->latest()->simplePaginate(8);
        $category = Category::select('image_url')->get();
    } 
        return view('posts.index', [
            'posts' => $post,
            'category' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validatePost($request);

        $post = new Post(request(['title', 'body', 'slug', 'image_url', 'category_id', 'is_approved']));

        if ($post->is_approved = $request->has('status')) {
        }

        if ($post->image_url = $request->has('image')) {
            $path = Storage::disk('s3')->put('images/', $request->file('image'));
            $post->image_url = basename($path);
        }
            $user = auth()->user();
            $post->user_id = $user->id;
            $post->save();
            $post->tags()->attach(request('tags'));

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $slug, Request $request)
    {
        $category = Category::all();

        return view('posts.show', [
            'post' => $slug,
            'category' => $category
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        $post->load('tags');
        $categories = Category::all();
        $tags = Tag::all();

        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Post $post, Request $request)
    {   
        $post->update($this->validatePost($request));

        $post->update(['is_approved' => $request->has('status')]);

        $post['user_id'] = auth()->id();

        if ($request->has('image')) {
            Storage::disk('s3')->delete('images/'.$post->image_url);
            $path = Storage::disk('s3')->put('images/', $request->file('image'));
            $post->image_url = basename($path);
            $post->save();
        }

        $post->save();

        $post->tags()->sync(request('tags'));

        return redirect('posts/' . $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $oldImage = public_path() . '/storage/img/post_uploads/' . $post->image_url;
        if (file_exists($oldImage)){
            unlink($oldImage);
        }

        $post->delete();

        return redirect('/dashboard/posts');
    }

    protected function validatePost($request) 
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'body'  => ['required'],
            'slug'  => ['required', 'string', 'max:100'],
            'tags' => ['exists:tags,id'],
            'category_id' => ['required'],
            'image' => ['sometimes', 'image']
        ]);
    }

}