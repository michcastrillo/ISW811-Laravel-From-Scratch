[< Volver al índice](/docs/readme.md)

# Laughably Simple Pagination

Vamos a utilizar la paginación para no mostrar todos los posts en una sola pagina, ya que si lo dejamos de esta manera podría provocar un problema en el rendimiento de la página a medida que vayan incremento los post.  

Lo primero que debemos cambiar es en el controlador donde la función *index* solo mostrará 6 post por página en `app/Http/Controller/PostController`.

```php
    public function index()
    {
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
                )->paginate(6)->withQueryString()
        ]);
    }
```

Para que se muestre la paginación  o el numero de paginas que tenemos en la interfaz debemos de cambiar el siguiente código en la vista `resources/views/posts/index.blade.php`.

```php
    @if ($posts->count())
        <x-posts-grid :posts="$posts" />
        {{ $posts->links() }}
    @else
        <p class="text-center">Not posts yet. Please check back later.</p>
    @endif
```

Por ultimo, para poder darle estilo a la paginación debemos ingresar los siguientes comandos en nuestra maquina virtual. 

```bash
php artisan vendor:publish 
17
```
Esto generará un nuevo directorio en `resources/views/vendor`. Estos archivos incluirán las vistas utilizados para estilizar la apariencia de la paginación.

![image](./images/ep44.png "Paginación")