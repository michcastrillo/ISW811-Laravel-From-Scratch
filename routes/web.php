<?php

use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);



Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');


Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');












// Route::get('authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'posts'=> $author->posts
//     ]);
// });


// Route::get('/example', function () {
//     return [['id'=>' 0 ','name' =>'ashley'],['id'=>' 1','name' =>'michelle']]; 

// });
// Route::get('/posts', function () {
//     return view('posts'); 
// });



//Episodio 7
// Route::get('/post', function () {
//     return view('post'); 
// });
