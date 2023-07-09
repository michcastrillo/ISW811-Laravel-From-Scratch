<?php

use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\PostCommentsController;


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'store']);


Route::get('register', [RegisterController::class, 'create'])->middleware('guest');
Route::post('register', [RegisterController::class, 'store'])->middleware('guest');

Route::get('login', [SessionsController::class, 'create'])->middleware('guest');
Route::post('login', [SessionsController::class, 'store'])->middleware('guest');

Route::post('logout', [SessionsController::class, 'destroy'])->middleware('auth');

Route::post('newsletter', function() {
	request()->validate(['email'=>'required|email']);

	$mailchimp = new \MailchimpMarketing\ApiClient();

	$mailchimp->setConfig([
		'apiKey' => config('services.mailchimp.key'),
		'server' => 'us12'
	]);

	try{
		$response = $mailchimp->lists->addListMember('6f0c5f1e34', [
            'email_address'=> request('email'),
            'status'=>"subscribed"
        ]);
	}catch(\Exception $e){
		throw \Illuminate\Validation\ValidationException::withMessages([
			'email'=>'This email could not be added to our newsletter list'
		]);
	}
	    

    return redirect('/')
		->with('success', 'You are now signed up for our newsletter');


});










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
