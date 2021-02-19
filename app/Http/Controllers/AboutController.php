<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\About;

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

        $fileExtension = request('profile')->getClientOriginalName();
        $fileName = pathInfo($fileExtension, PATHINFO_FILENAME);
        $extension = request('profile')->getClientOriginalExtension();
        $newFileName = $fileName . '_' . time() . '.' . $extension;
        $imgPath = request('profile')->storeAs('public/img/profile_pic', $newFileName);

        $about->image_url = $newFileName;
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
            $fileExtension = request('profile')->getClientOriginalName();
            $fileName = pathInfo($fileExtension, PATHINFO_FILENAME);
            $extension = request('profile')->getClientOriginalExtension();
            $newFileName = $fileName . '_' . time() . '.' . $extension;
            $imgPath = request('profile')->storeAs('public/img/profile_pic', $newFileName);

            unlink(storage_path('app/public/img/profile_pic/'.$about->image_url));
            $about->image_url = $newFileName;

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
