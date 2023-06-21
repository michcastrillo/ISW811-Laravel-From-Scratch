[< Volver al índice](/docs/readme.md)

# A Few Tweaks and Consideration
En este capítulo se realizan algunos ajustes  Primero, eliminaremos la restricción de ruta que ya no es necesaria. Se agrega un segundo método Post::findOrFail() que cancela automáticamente si no se encuentra ninguna publicación que coincida con el slug dado.Además se mejora la ruta para encontrar los posts. 
```php
    public static function findOrFail($slug)
    {
        $post = static::find($slug);

        if (! $post){
            throw new ModelNotFoundException();
        }
        return $post;
    }
```
```php
Route::get('posts/{post}', function ($slug) {
    return view('post', [
        'post'=> Post::findOrFail($slug)
    ]);
});
```
