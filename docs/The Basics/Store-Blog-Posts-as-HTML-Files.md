[< Volver al índice](/docs/readme.md)

# Store Blog Posts as HTML Files
En este capitulo se realizara el blog dinámico, para esto pondremos un redireccionamiento a cada contenido post.  
```php
<?=$post;?>
``` 
Además se agregara una carpeta posts la cual tendrá tres archivos, estos tendrán cada  contenido post por aparte. 
![image](./images/carpeta%20posts.png "carpeta posts")
\
Para el direccionamiento en las rutas siempre se tendrá un pagina principal posts, y luego un endpoint que pueda recibir cualquier ruta además de la principal: 'posts/{post}'. Se redirecciona a la carpeta donde están los post de manera individual. Ponemos una condición por si se coloca una URL que no tengamos, y se redirecciona a la pagina principal para evitar errores, al final se obtiene cada contenido de los post. 
```php
Route::get('/posts', function () {
    return view('posts'); 
});
Route::get('posts/{post}', function ($slug) {
    $path = __DIR__ . "/../resources/posts/{$slug}.html";

    if(! file_exists($path)){
        return redirect("/posts");
    }

    $post = file_get_contents($path);

    return view('post', [
        'post' => $post
    ]);
});
``` 
Cambiamos cada link por cada titulo en el cual almacenamos los post: 
```php
 <h1><a href="/posts/my-third-post">My third post</a></h1>
``` 