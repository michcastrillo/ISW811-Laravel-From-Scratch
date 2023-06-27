[< Volver al índice](/docs/readme.md)

# Route Wildcard Constraints
La siguiente linea nos asegura que al ingresar nuestra URL puede estar en mayúscula, minúscula, o cualquier carácter. Esto es posible gracias al *where* de nuestra ruta en el directorio *routes/web.php*.

```php
Route::get('posts/{post}', function ($slug) {
    
})->Where('post', '[A-z_\-]+');
``` 