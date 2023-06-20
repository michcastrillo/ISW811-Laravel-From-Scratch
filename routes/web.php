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
    return view('welcome');
});

Route::get('/example', function () {
    return [['id'=>' 0 ','name' =>'ashley'],['id'=>' 1','name' =>'michelle']]; 

});
Route::get('/posts', function () {
    return view('posts'); 
});
Route::get('posts/{post}', function ($slug) {

    if(! file_exists($path =  __DIR__ . "/../resources/posts/{$slug}.html")){
        return redirect("/posts");
    }

    $post = cache()->remember("posts.($slug)", 1200, fn() => file_get_contents($path));

    return view('post', ['post' => $post]);
    
})->Where('post', '[A-z_\-]+');


//Episodio 7
// Route::get('/post', function () {
//     return view('post'); 
// });
