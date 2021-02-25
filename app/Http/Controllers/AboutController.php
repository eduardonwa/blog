<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $about = About::latest(1);
        return view('dashboard', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateAbout($request);
        
        $about = new About(request(['message', 'reading_string', 'listening_string', 'listening_url', 'image_url']));

        $path = Storage::disk('s3')->put('images/', $request->file('profile'));
        $about->image_url = basename($path);
        $about->save();
        
        return redirect('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $about = About::find($id);
        return view('dashboard');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $this->validateAbout($request);

        if ($request->has('profile')) {
            Storage::disk('s3')->delete('images/'.$about->image_url);
            $path = Storage::disk('s3')->put('images/', $request->file('profile'));
            $about->image_url = basename($path);

            $about->save();
        }

        $about->save();

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function validateAbout($request) 
    {

    return $request->validate([
        'message' => ['required'],
        'reading_string' => ['required', 'max:255'],
        'listening_string' => ['required', 'max:255'],
        'listening_url' => ['required', 'url']
    ]);

    }
}
