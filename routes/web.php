<?php
use App\Models\Post;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;
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
    return view('posts', [
        'posts'=> Post::all()
    ]);
});

Route::get('posts/{post}', function ($slug) {

    return view('post', [
        'post'=> Post::find($slug)
    ]);

})->Where('post', '[A-z_\-]+');

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
