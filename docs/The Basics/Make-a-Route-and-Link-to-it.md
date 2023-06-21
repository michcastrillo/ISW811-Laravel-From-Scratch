[< Volver al índice](/docs/readme.md)

# Make a Route and Link to it
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