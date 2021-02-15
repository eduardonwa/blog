<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('dashboard.categories', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category(request(['name', 'image_url']));

        $fileExtension = request('icon')->getClientOriginalName();
        $fileName = pathInfo($fileExtension, PATHINFO_FILENAME);
        $extension = request('icon')->getClientOriginalExtension();
        $newFileName = $fileName . '_' . time() . '.' . $extension;
        $imgPath = request('icon')->storeAs('public/img/category', $newFileName);

        $category->image_url = $newFileName;
        
        $category->save();

        return redirect('/dashboard/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
       $category = Category::find($id);
       dd($category);

       return view('posts.show', compact($category));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category, Request $request)
    {   
        $validateData = request()->validate([
            'name' => ['required', 'string', 'max:255']
        ]);

        if ($request->has('image_url')) {
            $fileExtension = request('icon')->getClientOriginalName();
            $fileName = pathInfo($fileExtension, PATHINFO_FILENAME);
            $extension = request('icon')->getClientOriginalExtension();
            $newFileName = $fileName . '_' . time() . '.' . $extension;
            $imgPath = request('icon')->storeAs('public/img/post_uploads', $newFileName);

            $category->image_url = $newFileName;
            $category->save();
        }

        $category->update($validateData);

        return redirect('/dashboard/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $oldImage = public_path() . '/storage/img/category/' . $category->image_url;
        if (file_exists($oldImage)){
            unlink($oldImage);
        }

        $category->delete();

        return redirect('/dashboard/categories');
    }
}
