[< Volver al índice](/docs/readme.md)

# 3 Ways to Mitigate Mass Assignment Vulnerabilities

En esta lección, analizaremos todo lo que necesita se saber sobre las vulnerabilidades de asignación masiva. Como verá, Laravel proporciona un par de formas de especificar qué atributos pueden o no asignarse en masa. 

- *$fillable* es utilizado para aceptar solo los atributos que se asignen. EL siguiente código se coloca en el directorio *app/Models/Post.php*
```php
protected $fillable = ['title', 'excerpt', 'body'];
```
- Esta es otra manera de insertar contenido a la base de datos.
```bash
php artisan tinker;
Post::create(['title'=> 'My Third Post', 'excerpt'=> 'Lorem...', 'body' => 'this is the body']);
```
- Con *$guarded* se pueden ingresar cualquier *key* excepto la que este contenga. EL siguiente código se coloca en el directorio *app/Models/Post.php*
```php
protected $guarded = ['id'];
```
- Esta es una manera que se puede actualizar un valor. 
```bash
$post->update(['key' => 'value']);
```