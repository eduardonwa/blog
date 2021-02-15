<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function () {
    return view('test');
});

Route::get('/', function () {
    return view('welcome', [
        'posts' => App\Models\Post::where('is_approved', true)->take(3)->latest()->get(),
        'about' => App\Models\About::take(1)->latest()->get()
    ]);
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', [ContactController::class, 'incoming']);

Route::get('posts', 
    [PostsController::class, 'index']
);

Route::get('/posts/category', function () {
    return view('posts.category', [
        'posts' => App\Models\Post::latest()->get()
    ]);
});

Route::get('/dashboard/posts', function(){
    return view('dashboard.posts', [
        'posts' => App\Models\Post::get(),
        'comments' => App\Models\CustomComment::get()
    ]);
})->middleware('auth');

Route::get('/dashboard/categories', function(){
    return view('dashboard.categories', [
        'category' => App\Models\Category::get()
    ]);
})->middleware('auth');

require __DIR__.'/auth.php';

Route::resource('posts', PostsController::class)
    ->except('index', 'show')
    ->middleware('auth');
    Route::get(
    'posts/{slug}',
    [PostsController::class, 'show']
);

Route::resource('dashboard', HomeController::class)
    ->only('index')
    ->middleware('auth');
    
Route::resource('about', AboutController::class)->middleware('auth');
Route::resource('categories', CategoryController::class)->middleware('auth');