<?php

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

Route::get('/', function () {
    return view('home.index', []);
})->name('home.index');

Route::get('/contact', function () {
    return view('home.contact');
})->name('home.contact');

Route::get('/posts/{id}', function ($id) {
    $posts = [
        1 => [
            'title' => 'Intro to laravel',
            'content' => 'This is a short intro to laravel'
        ],
        
        2 => [
            'title' => 'Intro to PHP',
            'content' => 'This is a short intro to PHP'
        ]
        ];

    abort_if(!isset($posts[$id]), 404);

    return view('posts.show', ['post' => $posts[$id]]);
    // return 'Blog post ' . $id;
})->name('posts.show');

Route::get('/recent_posts/{days_ago?}', function ($daysAgo = 20) {
    return 'Posts from ' . $daysAgo . ' days ago';
})->name('posts.recent.index');