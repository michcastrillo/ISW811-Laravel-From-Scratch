[< Volver al índice](/docs/readme.md)

# View All Posts By An Author

Ahora que podemos asociar una publicación de blog con un autor, el siguiente paso es crear una nueva ruta que represente todas las publicaciones de blog escritas por un autor en particular. Por tanto debemos tener los siguientes endpoints *routes/web.php*:

- Exportamos el modelo usuario para obtener el username. 
```php
    use App\Models\User;
```

```php
    Route::get('/', function () {
        return view('posts', [
            'posts'=> Post::latest()->with(['category', 'author'])->get()
        ]);
    });

    Route::get('authors/{author:username}', function (User $author) {
        return view('posts', [
            'posts'=> $author->posts
        ]);
    });
```
En *database/migration/create_users_table.php* agregamos la columna de username para el usuario, y hacemos que esta sea unica para que no se pueda repetir ya que haremos parte la url. 
```php
    $table->string('username')->unique();
```
Así como también agregamos los cambios de la nueva columna de username, a la fabrica. En el directorio *database/factories/UserFactory.php*
```php
    'username'=> $this->faker->unique()->userName(),
```

En el modelo del post en *app/models/post.php* tenemos una función que asocia los post con el user_id, Laravel automáticamente espera author_id, por tanto le indicamos que esperamos el id del usuario. Esta función asocia el Post con el usuario. Primero importamos el model: 
```php
    use App\Models\User;
```

```php
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
```

Al darle clic al usuario queremos que solo aparexcan los post relacionados a este, y que la URL cambie a su username, por esto hacemos el mismo cambio en estos directorios. 
- *resources/views/posts.blade.php* 
- *resources/views/post.blade.php*

```html
<p>
    By <a href="/authors/{{$post->author->username}}">{{ $post->author->name}}</a> in <a href="/categories/{{$post->category->slug}}">{{ $post->category->name}}</a>
</p>
```
Digitamos el siguiente comando para que borre los datos que teníamos anteriormente y agregue los nuevos. 
```html
    php artisan migrate:fresh --seed
```

![image](./images/url%20by%20username%20ep29.png "URL por username")