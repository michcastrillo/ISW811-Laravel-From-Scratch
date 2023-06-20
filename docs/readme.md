# Curso de Laravel from Scratch

## Módulo 2 - Episodio 5 - How a Route Loads a View
A continuación se muestra como se manejan las rutas asociadas a una URL en Laravel: 
 ```php
   Route::get('/', function () {
    return view('welcome');
});
```
Si una ruta que no esta especificada o un se escribe un endpoint incorrecto se da un error 404, lo que significa que el enlace no esta habilitado. 
![image](./images/error%20404.png "without a route")
Es importante mencionar que las rutas pueden retornar un json, una vista HTML, un texto, entre otros. En este caso, nuestro endpoint es /example. 
 ```php
   Route::get('/example', function () {
    return [['id'=>' 0 ','name' =>'ashley'],['id'=>' 1','name' =>'michelle']]; 

});
```
![image](./images/example%20route%20json.png "json file")

## Módulo 2 - Episodio 6 - Include CSS and Javascript

En este episodio se muestra como incluir js(funcionalidad) y css (estilos) al HTML.
 ```php
<!DOCTYPE html>
<title>My blog</title>
<link rel="stylesheet" href="/app.css">
<script src="/app.js"></script>
<body>
    <h1>Hello world</h1>
</body>
```
Se creó un archivo app.css en la carpeta public, dandole estilo al cuerpo del html. , Es importante destacar que todos los archivos tipo css o js van en la carpeta public para un mejor enrutamiento de Laravel. 
 ```css
body{
    background: navy;
    color: white;
}
```
![image](./images/hello%20world.png "css added")

Se creó un archivo app.js en la carpeta public para darle una pequeña funcionalidad a la página, en este caso una ventana emergente.  
```js
alert('Im here');
```
![image](./images/alert.png "js added")
## Módulo 2 - Episodio 7 - Make a Route and Link to it
En este episodio se muestra como enlazar una vista a otra por medio de un link. Para esto un blog básico no dinámico con dos vistas en las cuales posts contendrá todos los artículos y post solo la información de una articulo: 
![image](./images/creaci%C3%B3n%20de%20vista%20post.png "post file")
\
Y sus respectivas rutas: 
 ```php
Route::get('/posts', function () {
    return view('posts');

});

Route::get('/post', function () {
    return view('post'); 
});
``` 

No solo podemos acceder a las vistas por medio de la URL sino también por medio del HTML, en este caso, por medio de un link accedemos a la vista post
```php
<h1><a href="/post">My first blog</a></h1>
``` 

    * Vista principal posts
![image](./images/posts%20page%20ep7.png "posts page")
    * Vista de un articulo post
![image](./images/post%20page%20ep7.png "post page")

## Módulo 2 - Episodio 8 - Store Blog Posts as HTML Files
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
## Módulo 2 - Episodio 9 - Route Wildcard Constraints
La siguiente linea nos asegura que al ingresar nuestra URL puede estar en mayúscula, miniscule, o cualquier caracter. 
```php

Route::get('posts/{post}', function ($slug) {
    
})->Where('post', '[A-z_\-]+');
``` 