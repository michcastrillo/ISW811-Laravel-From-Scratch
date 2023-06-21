[< Volver al índice](/docs/readme.md)

# Use Coaching for Expensive Operations
Al verificar si el archivo o la ruta existe, se le devuelve la vista, pero se esta ingresando al sistema de archivo cada vez que se accede a un post, lo que lo hace una pagina no tan renderizada, por esto es mejor almacenarla en el caché el tiempo que creamos conveniente, así el sistema evita leer el archivo cada vez que el usuario accede a un post, haciendo la pagina mas eficiente. 
```php

Route::get('posts/{post}', function ($slug) {

    if(! file_exists($path =  __DIR__ . "/../resources/posts/{$slug}.html")){
        return redirect("/posts");
    }

    $post = cache()->remember("posts.($slug)", 1200, fn() => file_get_contents($path));

    return view('post', ['post' => $post]);
    
})->Where('post', '[A-z_\-]+');
``` 