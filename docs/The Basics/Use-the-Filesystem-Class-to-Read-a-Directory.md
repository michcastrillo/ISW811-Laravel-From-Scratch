[< Volver al índice](/docs/readme.md)


# Use the Filesystem Class to Read a Directory
Ahora averigüemos cómo obtener y leer todas las publicaciones dentro del directorio de *resources*. Una vez que tenemos una matriz adecuada, podemos recorrerlos y mostrar cada uno en la página principal de descripción general del blog.
Primero crearemos un modelo en el directorio App.
\
![image](./images/model%20post.png "carpeta posts")
\
El cual tendrá estas dos funciones las cuales *all()*, nos permitirá acceder a cualquier post desde cualquier parte. Y *find()* encontrará cada post que creamos en el directorio de resources de manera singular. 
```php
  public static function all()
    {
        $files = File::files(resource_path("posts/"));
        
        return array_map(fn($file) => $file->getContents(), $files);
    }

    public static function find($slug)
    {
        if(!file_exists($path =  resource_path("posts/{$slug}.html"))){
           throw new  ModelNotFoundException();
        }

        $post = cache()->remember("posts.($slug)", 1200, fn() => file_get_contents($path));

        return view('post', ['post' => $post]);

    }
``` 
En la vista posts pondremos un foreach el cual nos traerá cada post, en vez de los links. 
```html
    <body>
        <?php foreach ($posts as $post) : ?>
        <article>
            <?= $post; ?>
        </article>
        <?php endforeach; ?>
    </body>
``` 
Estas serán nuestras dos únicas rutas, una para nuestra pagina principal el cual traerá y la otra para visualizar solo el contenido de cada post. Importante recordar que debemos exportar el modelo de Post. 

```php

    use App\Models\Post;



    Route::get('/', function () {
        return view('posts', [
            'posts'=> Post::all()
        ]);
    });

    Route::get('posts/{post}', function ($slug) {

        $post = Post::find($slug);

        return view('post', [
            'post'=> $post
        ]);

    })->Where('post', '[A-z_\-]+');
``` 