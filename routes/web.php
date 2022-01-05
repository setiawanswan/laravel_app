<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::get('/', [HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

Route::get('/single', AboutController::class);

// Simple View Rendering

// Route::view('/', 'home.index')->name('home.index');
// Route::view('/contact', 'home.contact')->name('home.contact');

$posts = [
    1 => [
        'title' => 'Intro to laravel',
        'content' => 'This is a short intro to laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ],

    3 => [
        'title' => 'Intro to Golang',
        'content' => 'This is a short intro to Golang',
        'is_new' => false
    ],

    4 => [
        'title' => 'Intro to Vue',
        'content' => 'This is a short intro to Vue',
        'is_new' => false
    ]
];

Route::get('/posts', function () use($posts) {
    // dd(request()->all());
    dd((int)request()->input('page', 1));

    return view('posts.index', ['posts' => $posts]);
});

Route::get('/posts/{id}', function ($id) use($posts) {
    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
    // return 'Blog post ' . $id;
})->name('posts.show');

Route::get('/recent_posts/{days_ago?}', function ($daysAgo = 20) {
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index')->middleware('auth');

Route::prefix('/fun')->name('fun.')->group(function() use($posts) {
    Route::get('/fun/response', function() use($posts) {
        return response($posts, 201)
        ->header('Content-Type', 'application/json')
        ->cookie('MY_COOKIE', 'Setiawan', 3600);
    })->name('responses');
    
    Route::get('/fun/redirect', function() {
        return redirect('/contact');
    });
    
    Route::get('/fun/back', function() {
        return back();
    });
    
    Route::get('/fun/named-route', function() {
        return redirect()->route('posts.show', ['id' => 1]);
    });
    
    Route::get('/fun/away', function() {
        return redirect()->away('http://google.com');
    });
    
    Route::get('/fun/json', function() use($posts) {
        return response()->json($posts);
    })->name('json');
});

