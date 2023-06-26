[< Volver al índice](/docs/readme.md)

# Route Model Binding

La función de vinculación del modelo de ruta de Laravel nos permite vincular un comodín de ruta a una instancia de modelo Eloquent. Para eso debemos hacer que al ingresar a un post el slug coincida con su URL. Para eso debemos ir al directorio *routes/web.php*, y cambiar nuestro endpoint. 
```php
Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', [
        'post'=> $post
    ]);
});
```

Debemos agregar una nueva key en nuestro esquema de Post de la base de datos, el cual se encuentra en *database/migration/create_posts_table.php*.
```php
$table->string('slug')->unique();
```
Para que se actualiza la tabla debemos de ingresar el siguiente comando: 
```bash
php artisan migrate:fresh
```
Sin embargo, se nos borrará el contenido de nuestras bases de datos, por tanto, debemos agregar una nueva de fila de datos, ahora con su slug. 
```bash
php artisan tinker
$post = new App\Models\Post;
$post->slug = 'my-first-post';
$post->title = 'My First Post';
$post->excerpt = 'Lorem ipsum dolar sit amet.';
$post->body = 'This is the body of the Post :)';
$post->save();
```
Anteriormente, nuestra aplicación estaba buscando los post por su id, por esto en el directorio de *resources/views/posts.blade.php* debemos cambiarlo.
```html
 <a href="/posts/{{$post->slug; }}">{{ $post->title; }</a>
```

 ![image](./images/searching%20by%20slug%20ep22.png "Searching by slug")